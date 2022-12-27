<?php

namespace App\EventListener\Order;

use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class OrderCompleteListener
{
    public function __construct(private OrderEmailManagerInterface $orderEmailManager)
    {
    }

    public function sendConfirmationEmail(GenericEvent $event): void
    {
        $order = $event->getSubject();
        Assert::isInstanceOf($order, OrderInterface::class);

        $this->orderEmailManager->sendConfirmationEmail($order);
    }
}
