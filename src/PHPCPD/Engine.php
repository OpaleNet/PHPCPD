<?php
namespace Opale\PHPCPD;

use Opale\PHPCPD\Writers\WriterInterface;
use SebastianBergmann\PHPCPD\Detector\Detector;
use SebastianBergmann\PHPCPD\Detector\Strategy\DefaultStrategy;
use SebastianBergmann\FinderFacade\FinderFacade;

class Engine
{
    /**
     * @var Formatter
     */
    private $formatter;
    /**
     * @var array
     */
    private $config;
    /**
     * @var WriterInterface
     */
    private $errorWriter;
    /**
     * @var WriterInterface
     */
    private $defaultWriter;

    /**
     * @param array           $config
     * @param Formatter       $formatter
     * @param WriterInterface $defaultWriter
     * @param WriterInterface $errorWriter
     */
    public function __construct(
        array $config,
        Formatter $formatter,
        WriterInterface $defaultWriter,
        WriterInterface $errorWriter
    ) {
        $this->formatter = $formatter;
        $this->config = $config;
        $this->defaultWriter = $defaultWriter;
        $this->errorWriter = $errorWriter;
    }
    /**
     *
     * @return int 0 if success, otherwise failure
     */
    public function run()
    {
        try {
            list($includePaths, $includeFiles) = $this->fillPathsAndFiles('include_paths');
            list($excludePaths, $excludeFiles) = $this->fillPathsAndFiles('exclude_paths');
            $finder = new FinderFacade(
                $includePaths,
                $excludePaths,
                $includeFiles,
                $excludeFiles
            );
            $files = $finder->findFiles();

            if (empty($files)) {
                return 0;
            }
            $this->analyze($files);

        } catch (\Exception $e) {
            $this->errorWriter->write($e->getMessage());

            return 1;
        }

        return 0;
    }
    /**
     * @param string $key
     *
     * @return array
     */
    protected function fillPathsAndFiles($key)
    {
        $paths = [];
        $files = [];

        if (isset($this->config[$key])) {
            foreach ($this->config[$key] as $path) {
                if ($path !== $nonSlashedPath = rtrim($path, '/')) {
                    $paths[] = $nonSlashedPath;
                } else {
                    $files[] = $path;
                }
            }
        }

        return [$paths, $files];
    }
    /**
     * @param $files
     *
     * @return array
     */
    protected function analyze($files)
    {
        $strategy = new DefaultStrategy();
        $detector = new Detector($strategy);

        $clones = $detector->copyPasteDetection(
            $files,
            $this->config['lines'],
            $this->config['tokens'],
            $this->config['fuzzy']
        );

        $reports = $this->formatter->formatResults($clones);
        foreach ($reports as $key => $report) {
            $this->defaultWriter->write($report);
        }
    }
}
