<?php

namespace App\Service\Order;

final class OrderNumberAssigner implements OrderNumberAssignerInterface
{
    public function __construct(private readonly OrderNumberGeneratorInterface $numberGenerator)
    {
    }

    public function assignNumber(OrderInterface $order): void
    {
        if (null !== $order->getNumber()) {
            return;
        }

        $order->setNumber($this->numberGenerator->generate($order));
    }
}
