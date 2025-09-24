<?php

namespace App\EventListener;

use App\Entity\User;
use App\Service\Notification\NotificationService;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CustomerEmailUpdaterListener
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    public function postUpdate(User $user, LifecycleEventArgs $args): void
    {
        if (!$user->isEmailVerified()) {
            $this->notificationService->sendEmail(
                $user->getEmail(),
                'Verify your email',
                'Hello ' . $user->getUsername() . ', please verify your email by clicking the link.'
            );
        }
    }
}
