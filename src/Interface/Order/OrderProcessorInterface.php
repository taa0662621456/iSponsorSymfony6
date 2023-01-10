<?php

namespace App\Interface\Order;

interface OrderProcessorInterface
{
    public function process(OrderInterface $order): void;

}
