<?php

namespace App\Interface\Order;

interface OrderEmailConfirmationInterface
{
    public function orderEmailConfirmation(OrderInterface $order): void;
}
