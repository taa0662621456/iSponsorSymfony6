<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LocaleManagerSubscriber implements EventSubscriberInterface
{
    private array $supportedLocales;

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        string $locales,
        private readonly string $locale
    ) {
        $this->supportedLocales = explode('|', trim($locales));
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // Попытка получить локаль из URL
        $locale = $request->attributes->get('_locale');
        if ($locale && in_array($locale, $this->supportedLocales, true)) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // Получение локали из сессии или использование локали по умолчанию
            $locale = $request->getSession()->get('_locale', $this->locale);
            $request->setLocale($locale);
        }

        // Переадресация, если локаль в запросе отличается от текущей локали в сессии
        if ($locale !== $this->locale && $locale !== $request->getLocale()) {
            $response = new RedirectResponse($this->urlGenerator->generate('homepage', ['_locale' => $locale]));
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => [['onKernelRequest', 20]]];
    }

}