<?php

namespace App\EventListener\Listener_Sylius;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\EventListener\LocaleAwareListener;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleAwaresListener
// class LocaleAwaresListener implements EventSubscriberInterface
{
//    public function __construct(private readonly LocaleAwareListener $decoratedListener)
//    {
//    }
//
//    public function onKernelRequest(RequestEvent $event): void
//    {
//        $this->decoratedListener->onKernelRequest($event);
//    }
//
//    public function onKernelFinishRequest(FinishRequestEvent $event): void
//    {
//        $this->decoratedListener->onKernelFinishRequest($event);
//    }
//
//    #[ArrayShape([KernelEvents::REQUEST => "array[]", KernelEvents::FINISH_REQUEST => "array[]"])]
//    public static function getSubscribedEvents(): array
//    {
//        return [
//            // must be registered after the Locale listener
//            KernelEvents::REQUEST => [['onKernelRequest', 4]],
//            KernelEvents::FINISH_REQUEST => [['onKernelFinishRequest', -15]],
//        ];
//    }
}
