<?php
namespace Opale\PHPCPD\Writers;

interface WriterInterface
{
    /**
     * @param string $string
     */
    public function write($string);
}
