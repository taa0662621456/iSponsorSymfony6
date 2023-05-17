<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionLoggerListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $errorMessage = $exception->getMessage();

        // Log the error message
        $this->logger->error($errorMessage);
    }
}
