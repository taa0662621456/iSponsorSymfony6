<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class XFrameOptionsSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([KernelEvents::RESPONSE => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$this->isMainRequest($event)) {
            return;
        }

        $response = $event->getResponse();

        $response->headers->set('X-Frame-Options', 'sameorigin');
    }

    private function isMainRequest(ResponseEvent $event): bool
    {
        if (\method_exists($event, 'isMainRequest')) {
            return $event->isMainRequest();
        }

        /* @phpstan-ignore-next-line */
        return $event->isMainRequest();
    }
}
