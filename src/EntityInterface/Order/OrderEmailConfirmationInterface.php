<?php

namespace App\EntityInterface\Order;

interface OrderEmailConfirmationInterface
{
    public function orderEmailConfirmation(OrderInterface $order): void;
}
