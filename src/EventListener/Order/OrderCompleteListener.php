<?php
namespace App\EventListener\Order;

use App\Entity\Order\Order;
use App\Service\Order\OrderManager;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderCompleteListener
{
    public function __construct(
        private readonly OrderManager $orderManager
    ) {}

    public function onOrderCompleted(GenericEvent $event): void
    {
        $order = $event->getSubject();
        if ($order instanceof Order) {
            $this->orderManager->finalize($order);
        }
    }
}
