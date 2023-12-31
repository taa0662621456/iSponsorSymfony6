<?php

namespace App\EventListener\Order;

use Webmozart\Assert\Assert;
use App\Interface\Order\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Interface\Order\OrderEmailConfirmationInterface;

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
