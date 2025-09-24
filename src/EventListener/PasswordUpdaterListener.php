<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\GenericEvent;

class PasswordUpdaterListener
{
    public function __construct(private PasswordUpdaterInterface $passwordUpdater)
    {
    }

    public function genericEventUpdater(GenericEvent $event): void
    {
        $this->updatePassword($event->getSubject());
    }

    public function prePersist(LifecycleEventArgs $event): void
    {
        $user = $event->getObject();

        if (!$user instanceof UserInterface) {
            return;
        }

        $this->updatePassword($user);
    }

    public function preUpdate(LifecycleEventArgs $event): void
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