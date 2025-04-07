<?php

namespace App\EventListener\Vendor;

use App\EntityInterface\Vendor\VendorSecurityForgotPasswordInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs as BaseLifecycleEventArgs;

class VendorPasswordUpdaterListener
{
    public function __construct(private readonly VendorSecurityForgotPasswordInterface $passwordUpdater)
    {
    }

    public function genericEventUpdater(GenericEvent $event): void
    {
        $this->updatePassword($event->getSubject());
    }

    public function prePersist(BaseLifecycleEventArgs $event): void
    {
        $user = $event->getObject();

        if (!$user instanceof UserInterface) {
            return;
        }

        $this->updatePassword($user);
    }

    public function preUpdate(BaseLifecycleEventArgs $event): void
    {
        $user = $event->getObject();

        if (!$user instanceof UserInterface) {
            return;
        }

        $this->updatePassword($user);
    }

    protected function updatePassword(UserInterface $user): void
    {
        if (null !== $user->getPlainPassword()) {
            $this->passwordUpdater->updatePassword($user);
        }
    }
}
