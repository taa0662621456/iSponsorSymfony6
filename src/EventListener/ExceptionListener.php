<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {

        $throwable = $event->getThrowable();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $throwable->getMessage(),
            $throwable->getCode()
        );


        $response = new Response();
        $response->setContent($message);

        if ($throwable instanceof HttpExceptionInterface) {
            $response->setStatusCode($throwable->getStatusCode());
            $response->headers->replace($throwable->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}