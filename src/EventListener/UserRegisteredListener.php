<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\Vendor\Vendor;
use App\Service\Notification\NotificationService;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UserRegisteredListener
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    public function postPersist(Vendor $user, LifecycleEventArgs $args): void
    {
        $this->notificationService->sendEmail(
            $user->getEmail(),
            'Welcome to our platform',
            'Hello ' . $user->getUsername() . ', your account has been created successfully.'
        );
    }
}
