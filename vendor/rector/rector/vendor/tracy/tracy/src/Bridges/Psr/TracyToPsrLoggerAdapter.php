<?php

/**
 * This file is part of the Tracy (https://tracy.nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace RectorPrefix20220501\Tracy\Bridges\Psr;

use RectorPrefix20220501\Psr;
use RectorPrefix20220501\Tracy;
/**
 * Tracy\ILogger to Psr\Log\LoggerInterface adapter.
 */
class TracyToPsrLoggerAdapter extends \RectorPrefix20220501\Psr\Log\AbstractLogger
{
    /** PSR-3 log level to Tracy logger level mapping */
    private const LevelMap = [\RectorPrefix20220501\Psr\Log\LogLevel::EMERGENCY => \RectorPrefix20220501\Tracy\ILogger::CRITICAL, \RectorPrefix20220501\Psr\Log\LogLevel::ALERT => \RectorPrefix20220501\Tracy\ILogger::CRITICAL, \RectorPrefix20220501\Psr\Log\LogLevel::CRITICAL => \RectorPrefix20220501\Tracy\ILogger::CRITICAL, \RectorPrefix20220501\Psr\Log\LogLevel::ERROR => \RectorPrefix20220501\Tracy\ILogger::ERROR, \RectorPrefix20220501\Psr\Log\LogLevel::WARNING => \RectorPrefix20220501\Tracy\ILogger::WARNING, \RectorPrefix20220501\Psr\Log\LogLevel::NOTICE => \RectorPrefix20220501\Tracy\ILogger::WARNING, \RectorPrefix20220501\Psr\Log\LogLevel::INFO => \RectorPrefix20220501\Tracy\ILogger::INFO, \RectorPrefix20220501\Psr\Log\LogLevel::DEBUG => \RectorPrefix20220501\Tracy\ILogger::DEBUG];
    /** @var Tracy\ILogger */
    private $tracyLogger;
    public function __construct(\RectorPrefix20220501\Tracy\ILogger $tracyLogger)
    {
        $this->tracyLogger = $tracyLogger;
    }
    public function log($level, $message, array $context = []) : void
    {
        $level = self::LevelMap[$level] ?? \RectorPrefix20220501\Tracy\ILogger::ERROR;
        if (isset($context['exception']) && $context['exception'] instanceof \Throwable) {
            $this->tracyLogger->log($context['exception'], $level);
            unset($context['exception']);
        }
        if ($context) {
            $message = ['message' => $message, 'context' => $context];
        }
        $this->tracyLogger->log($message, $level);
    }
}
