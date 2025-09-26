<?php

namespace App\EventListener\User;

use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class UserReloaderListener
{
    public function __construct(private readonly UserReloaderInterface $userReloader)
    {
    }

    public function reloadUser(GenericEvent $event): void
    {
        $user = $event->getSubject();

        Assert::isInstanceOf($user, UserInterface::class);

        $this->userReloader->reloadUser($user);
    }
}
