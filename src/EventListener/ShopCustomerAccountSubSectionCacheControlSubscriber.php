<?php

namespace App\EventListener;

use App\Interface\SectionProviderInterface;
use App\Service\ShopCustomerAccountSubSection;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ShopCustomerAccountSubSectionCacheControlSubscriber implements EventSubscriberInterface
{
    /** @var SectionProviderInterface */
    private SectionProviderInterface $sectionProvider;

    public function __construct(SectionProviderInterface $sectionProvider)
    {
        $this->sectionProvider = $sectionProvider;
    }

    #[ArrayShape([KernelEvents::RESPONSE => "string"])]
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

        $response->headers->addCacheControlDirective('no-cache', true);
        $response->headers->addCacheControlDirective('max-age', '0');
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->headers->addCacheControlDirective('no-store', true);
    }
}
