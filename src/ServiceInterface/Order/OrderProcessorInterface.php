<?php

namespace App\ServiceInterface\Order;

use App\EntityInterface\Order\OrderStorageInterface;

interface OrderProcessorInterface
{
    public function process(OrderStorageInterface $order): void;
}