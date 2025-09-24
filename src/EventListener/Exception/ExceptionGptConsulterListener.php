<?php

namespace App\EventListener\Exception;

use App\Service\GptExceptionConsulter;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionGptConsulterListener
{

    public function __construct(private readonly GptExceptionConsulter $coDev)
    {
    }

    #[NoReturn]
    public function onKernelException(ExceptionEvent $event): string
    {
        $exception = $event->getThrowable();
        $className = get_class($exception);
        $exceptionMessage = $exception->getMessage();
        $comment = $this->coDev->generateComment($className, $exceptionMessage);

        echo $comment;
        return $comment;
    }
}