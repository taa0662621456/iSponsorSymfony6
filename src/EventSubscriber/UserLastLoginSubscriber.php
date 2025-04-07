<?php

namespace App\EventSubscriber;

use App\Event\VendorEvent;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use UnexpectedValueException;

/**
 * @property $userManager
 */
final class UserLastLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly string $userClass = 'data_class')
    {
    }

    #[ArrayShape([SecurityEvents::INTERACTIVE_LOGIN => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
//            VendorEvent::VENDOR_SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
        ];
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event): void
    {
        $this->updateUserLastLogin($event->getAuthenticationToken()->getUser());
    }

    public function onImplicitLogin(VendorEvent $event): void
    {
        $this->updateUserLastLogin($event->getUser());
    }

    private function updateUserLastLogin($user): void
    {
        if (!$user instanceof $this->userClass) {
            return;
        }

        if (!$user instanceof UserInterface) {
            throw new UnexpectedValueException('In order to use this subscriber, your class has to implement UserInterface');
        }

        $user->setLastLogin(new DateTime());
        $this->userManager->persist($user);
        $this->userManager->flush();
    }
}
