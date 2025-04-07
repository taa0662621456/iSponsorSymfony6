<?php

namespace App\EventListener\Exception;

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

        $errorClass = 'NoErrorClass';
        $errorLine = 'NoErrorLine';

        // Перебираем трассировку стека, чтобы найти первый элемент, связанный с вашим проектом
        foreach ($exception->getTrace() as $trace) {
            if (isset($trace['file']) && str_contains($trace['file'], '/src/')) {
                $errorClass = $trace['class'] ?? '';
                $errorLine = $trace['line'] ?? '';
                break;
            }

            $this->logger->error($errorMessage, [
                'exceptionClass' => get_class($exception),
                'errorClass' => $errorClass,
                'errorLine' => $errorLine
            ]);
        }
    }
}
