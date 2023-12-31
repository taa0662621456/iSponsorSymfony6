<?php

namespace App\EntityInterface\Order;

interface OrderEmailConfirmationInterface
{
    public function orderEmailConfirmation(OrderStorageInterface $order): void;
}
