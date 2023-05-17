<?php

namespace App\EntityInterface\Order;

interface OrderProcessorInterface
{
    public function process(OrderInterface $order): void;

}
