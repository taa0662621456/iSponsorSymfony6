<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event): string
    {
        if (!$event->isMainRequest()) {
            return '// ничего не делайте, если это не основной запрос';
        }

        return '// что-то делайте, если это не основной запрос';
    }
}
