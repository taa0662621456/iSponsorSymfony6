<?php

namespace App\EventListener\User;

use App\Event\UserEvent;
use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

final class UserLastLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly ObjectManager $userManager, private readonly string $userClass)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
//            UserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
        ];
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->updateUserLastLogin($event->getAuthenticationToken()->getUser());
    }

    public function onImplicitLogin(UserEvent $event)
    {
        $this->updateUserLastLogin($event->getUser());
    }

    private function updateUserLastLogin($user): void
    {
        if (!$user instanceof $this->userClass) {
            return;
        }

        if (!$user instanceof UserInterface) {
            throw new \UnexpectedValueException('In order to use this subscriber, your class has to implement UserInterface');
        }

        $user->setLastLogin(new \DateTime());
        $this->userManager->persist($user);
        $this->userManager->flush();
    }
}