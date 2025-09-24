<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use App\Service\ShopCustomerAccountSubSection;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @property $sectionProvider
 */
final class ShopCustomerAccountSubSectionCacheControlSubscriber implements EventSubscriberInterface
{

    public function __construct()
    {
    }

    #[ArrayShape([KernelEvents::RESPONSE => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'setCacheControlDirectives',
        ];
    }

    public function setCacheControlDirectives(ResponseEvent $event): void
    {
        if (!$this->sectionProvider->getSection() instanceof ShopCustomerAccountSubSection) {
            return;
        }

        $response = $event->getResponse();

        $response->headers->addCacheControlDirective('no-cache');
        $response->headers->addCacheControlDirective('max-age', '0');
        $response->headers->addCacheControlDirective('must-revalidate');
        $response->headers->addCacheControlDirective('no-store');
    }
}