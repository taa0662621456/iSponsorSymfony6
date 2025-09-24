<?php

namespace App\EventListener;

use App\Exception\LocaleNotFoundException;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class RequestLocaleSetterListener
{
    public function __construct(private readonly LocaleContextInterface  $localeContext,
                                private readonly LocaleProviderInterface $localeProvider)
    {
    }

    /**
     * @throws LocaleNotFoundException
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $request->setLocale($this->localeContext->getLocaleCode());
        $request->setDefaultLocale($this->localeProvider->getDefaultLocaleCode());
    }
}