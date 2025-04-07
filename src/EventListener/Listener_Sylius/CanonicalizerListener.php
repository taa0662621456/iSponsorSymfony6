<?php

namespace App\EventListener\Listener_Sylius;

use App\EntityInterface\Customer\CustomerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\User\UserInterface;

final class CanonicalizerListener
{
    public function __construct(private readonly CanonicalizerInterface $canonicalizer)
    {
    }

    public function canonicalize(LifecycleEventArgs $event): void
    {
        $item = $event->getObject();

        if ($item instanceof CustomerInterface) {
            $item->setEmailCanonical($this->canonicalizer->canonicalize($item->getEmail()));
        } elseif ($item instanceof UserInterface && method_exists($item, 'getUsername')) {
            $item->setUsernameCanonical($this->canonicalizer->canonicalize($item->getUsername()));
            $item->setEmailCanonical($this->canonicalizer->canonicalize($item->getEmail()));
        }
    }

    public function prePersist(LifecycleEventArgs $event): void
    {
        $this->canonicalize($event);
    }

    public function preUpdate(LifecycleEventArgs $event): void
    {
        $this->canonicalize($event);
    }
}
