<?php
namespace Opale\PHPCPD;

use SebastianBergmann\PHPCPD\CodeCloneMap;

class Formatter
{
    /**
     * Displays a security report as json.
     *
     * @param CodeCloneMap $clones An array of issues
     *
     * @return array
     */
    public function formatResults(CodeCloneMap $clones)
    {
        $formattedIssues = [];
        $issueFormat = [
            'type' => 'issue',
            'check_name' => 'Duplicate code issue',
            'categories' => ['Bug Risk'],
            'content' => ['body' => 'Check if code can be refactored'],
            'description' => 'Found code that is duplicated',
        ];

        foreach ($clones as $dependency => $clone) {
            $issueFormat['location'] = [
                'path' => $clone->getName(),
                'lines' => ['begin' => $clone->getStartLine(), 'end' => $clone->getStartLine() + $clone->getSize()],
            ];
            $formattedIssues[] = $issueFormat;
        }

        return $formattedIssues;
    }
}
