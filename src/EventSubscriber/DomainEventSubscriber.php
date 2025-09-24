<?php
namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DomainEventSubscriber implements EventSubscriber
{
    public function __construct(private EventDispatcherInterface $dispatcher) {}

    public function getSubscribedEvents(): array
    {
        return [Events::postFlush];
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();
        foreach ($em->getUnitOfWork()->getIdentityMap() as $entities) {
            foreach ($entities as $entity) {
                if (method_exists($entity, 'releaseEvents')) {
                    foreach ($entity->releaseEvents() as $event) {
                        $this->dispatcher->dispatch($event);
                    }
                }
            }
        }
    }
}
