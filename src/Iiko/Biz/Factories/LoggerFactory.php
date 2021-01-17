<?php

namespace Iiko\Biz\Factories;

use DateTime;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class LoggerFactory
{
    public function create(string $channel = 'log', string $fileHandle)
    {
        $logger = new Logger($channel);
        $formatter = new LineFormatter(null, 'Y-m-d H:i:s', false, true);
        $now = (new DateTime('now'))->format('Y-m-d');
        $handler = new StreamHandler(str_replace('.log', "-{$now}.log", $fileHandle), Logger::INFO);
        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);
        return $logger;
    }
}
