<?php
namespace App\EventListener\Order;

use App\Entity\Order\Order;
use App\Service\Order\OrderManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

final class OrderRecalculationListener
{
    public function __construct(
        private readonly OrderManager $orderManager
    ) {}

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        if ($entity instanceof Order) {
            $this->orderManager->finalize($entity);
        }
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        if ($entity instanceof Order) {
            $this->orderManager->finalize($entity);
        }
    }
}
