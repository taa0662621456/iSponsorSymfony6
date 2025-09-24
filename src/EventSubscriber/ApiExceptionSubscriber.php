<?php

namespace App\EventSubscriber;

use Composer\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly LoggerInterface $logger) {}

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onException'];
    }

    public function onException(ExceptionEvent $event): void
    {
        $req = $event->getRequest();
        if (!str_starts_with($req->getPathInfo(), '/api')) return;

        $e = $event->getThrowable();
        $this->logger->error('api_error', ['e' => $e]);

        $data = ['error' => 'INTERNAL_ERROR'];
        if ($this->isSafe($e)) $data['detail'] = $e->getMessage();

        $res = new JsonResponse($data, 500);
        $res->headers->set('Cache-Control', 'no-store, max-age=0');
        $event->setResponse($res);
    }

    private function isSafe(\Throwable $e): bool
    {
        return $e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
    }

}