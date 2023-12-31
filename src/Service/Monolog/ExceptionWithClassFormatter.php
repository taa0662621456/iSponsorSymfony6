<?php

namespace App\Service\Monolog;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\LogRecord;

class ExceptionWithClassFormatter extends NormalizerFormatter
{
    public function format(LogRecord $record): string
    {
        $message = $record->message;
        $context = $record->context;

        $exceptionClass = $context['exceptionClass'] ?? 'No exception class';
        $errorClass = $context['errorClass'] ?? 'No error class';
        $errorLine = $context['errorLine'] ?? 'No error line';

        return sprintf("[%s at %s line %s]: %s\n", $errorClass, $exceptionClass, $errorLine, $message);
    }


}
