<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class VendorLocaleSubscriber implements EventSubscriberInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $session = $this->requestStack->getSession();
        if (null !== $user->getLocale()) {
            $session->set('_locale', $user->getLocale());
        }
    }

    #[ArrayShape(['response' => 'string'])]
    public static function getSubscribedEvents(): array
    {
        // TODO: Implement getSubscribedEvents() method.
        // return ['response' => 'onInteractiveLogin'];
        return ['response' => ['onInteractiveLogin', -255]];
    }
}
