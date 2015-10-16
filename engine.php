<?php

require __DIR__.'/vendor/autoload.php';

use Opale\PHPCPD\Engine;
use Opale\PHPCPD\Formatter;
use \Opale\PHPCPD\Writers\DefaultWriter;
use \Opale\PHPCPD\Writers\ErrorWriter;

set_error_handler(
    function ($errorNumber, $errorMessage, $errorFile, $errorLine) {
        throw new ErrorException($errorMessage, $errorNumber, $errorNumber, $errorFile, $errorLine);
    }
);
date_default_timezone_set('UTC');

$config = json_decode(file_get_contents('/config.json'), true);
$engine = new Engine($config, new Formatter(), new DefaultWriter(), new ErrorWriter());
$engine->run();
