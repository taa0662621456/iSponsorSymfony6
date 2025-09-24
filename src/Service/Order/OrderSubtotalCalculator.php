<?php

namespace App\Service\Order;

final class OrderSubtotalCalculator implements OrderItemsSubtotalCalculatorInterface
{
    public function getSubtotal(OrderInterface $order): int
    {
        return array_reduce(
            $order->getItems()->toArray(),
            static fn (int $subtotal, OrderItemInterface $item): int => $subtotal + $item->getSubtotal(),
            0,
        );
    }
}