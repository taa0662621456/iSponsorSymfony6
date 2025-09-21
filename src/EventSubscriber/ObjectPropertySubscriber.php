<?php

namespace App\EventSubscriber;

use App\Entity\Embeddable\ObjectProperty;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Security;

class ObjectPropertySubscriber implements EventSubscriber
{
    public function __construct(
        private readonly Security $security
    ) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::postLoad,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!method_exists($entity, 'getObjectProperty')) {
            return;
        }

        $property = $entity->getObjectProperty();
        if ($property instanceof ObjectProperty) {
            $userId = $this->getUserId();
            if ($userId) {
                $property->markCreated($userId);
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!method_exists($entity, 'getObjectProperty')) {
            return;
        }

        $property = $entity->getObjectProperty();
        if ($property instanceof ObjectProperty) {
            $userId = $this->getUserId();
            if ($userId) {
                $property->markModified($userId);
            }

            if ($args->hasChangedField('locked_by') && $userId) {
                $property->markLocked($userId);
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!method_exists($entity, 'getObjectProperty')) {
            return;
        }

        $property = $entity->getObjectProperty();
        if ($property instanceof ObjectProperty) {
            $property->markLastRequestNow();
        }
    }

    private function getUserId(): ?int
    {
        $user = $this->security->getUser();
        return $user && method_exists($user, 'getId') ? $user->getId() : null;
    }
}
