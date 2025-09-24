<?php
namespace App\Service\Order;

use App\Entity\Order\Order;

interface OrderProcessorInterface
{
    public function process(Order $order): void;
}
