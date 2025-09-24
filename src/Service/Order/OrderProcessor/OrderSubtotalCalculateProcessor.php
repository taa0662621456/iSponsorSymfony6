<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderItemInterface;
use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderSubtotalCalculatorInterface;

final class OrderSubtotalCalculateProcessor implements OrderSubtotalCalculatorInterface
{
    public function getSubtotal(OrderStorageInterface $order): int
    {
        return array_reduce(
            $order->getItems()->toArray(),
            static fn (int $subtotal, OrderItemInterface $item): int => $subtotal + $item->getSubtotal(),
            0,
        );
    }
}