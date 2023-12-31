<?php

namespace App\Service\Order;

use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderNumberAssignerInterface;
use App\ServiceInterface\Order\OrderNumberGeneratorInterface;

final class OrderNumberAssigner implements OrderNumberAssignerInterface
{
    public function __construct(private readonly OrderNumberGeneratorInterface $numberGenerator)
    {
    }

    public function assignNumber(OrderStorageInterface $order): void
    {
        if (null !== $order->getNumber()) {
            return;
        }

        $order->setOrderNumber($this->numberGenerator->generate($order));
    }
}
