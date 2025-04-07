<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SwitchVendorSubscriber implements EventSubscriberInterface
{
    public function onSwitchVendor(SwitchUserEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->hasSession() && ($session = $request->getSession())) {
            $session->set(
                '_locale',
                // assuming your User has some getLocale() method
                $event->getTargetUser()->getLocale()
            );
        }
    }

    #[ArrayShape([SecurityEvents::SWITCH_USER => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
                // constant for security.switch_user
                SecurityEvents::SWITCH_USER => 'onSwitchVendor',
            ];
    }
}
