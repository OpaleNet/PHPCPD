<?php
namespace Opale\PHPCPD\Writers;

class DefaultWriter implements WriterInterface
{
    /**
     * @inheritdoc
     */
    public function write($string)
    {
        fwrite(STDOUT, json_encode($string, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE)."\0");
    }
}
