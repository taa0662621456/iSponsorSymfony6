<?php

namespace App\EventListener\Order;

use App\EntityInterface\Order\OrderEmailConfirmationInterface;
use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderCompleteListener
{
    public function __construct(private readonly OrderEmailConfirmationInterface $orderEmailConfirmation)
    {
    }

    public function sendConfirmationEmail(GenericEvent $event): void
    {
        $order = $event->getSubject();
        Assert::isInstanceOf($order, OrderInterface::class);

        $this->orderEmailConfirmation->orderEmailConfirmation($order);
    }
}
