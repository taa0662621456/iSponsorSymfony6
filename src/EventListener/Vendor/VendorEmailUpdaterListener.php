<?php

namespace App\EventListener\Vendor;

use App\Entity\Vendor;
use App\Service\Notification\NotificationService;
use Doctrine\ORM\Event\LifecycleEventArgs;

class VendorEmailUpdaterListener
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    public function postUpdate(Vendor $vendor, LifecycleEventArgs $args): void
    {
        if (!$vendor->isEmailVerified()) {
            $this->notificationService->sendEmail(
                $vendor->getEmail(),
                'Verify your vendor account',
                'Hello ' . $vendor->getName() . ', please verify your vendor account by clicking the link.'
            );
        }
    }
}
