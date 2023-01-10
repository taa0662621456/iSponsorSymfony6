<?php

namespace App\EventListener\Order;

use App\Interface\Order\OrderEmailConfirmationInterface;
use App\Interface\Order\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

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
