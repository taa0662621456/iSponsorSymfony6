<?php

namespace App\Service\User;

use Doctrine\Persistence\ObjectManager;

final class UserReloader implements UserReloaderInterface
{
    public function __construct(private readonly ObjectManager $objectManager)
    {
    }

    public function reloadUser(UserInterface $user): void
    {
        $this->objectManager->refresh($user);
    }
}
