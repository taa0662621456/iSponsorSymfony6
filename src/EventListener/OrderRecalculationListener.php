<?php

namespace App\EventListener;

use App\Entity\Order;
use App\Service\Order\OrderCalculator;
use Doctrine\ORM\Event\LifecycleEventArgs;

class OrderRecalculationListener
{
    public function __construct(
        private readonly OrderCalculator $orderCalculator
    ) {}

    public function prePersist(OrderStorage $order, LifecycleEventArgs $args): void
    {
        $this->orderCalculator->recalculate($order);
    }

    public function preUpdate(OrderStorage $order, LifecycleEventArgs $args): void
    {
        $this->orderCalculator->recalculate($order);
    }
}
