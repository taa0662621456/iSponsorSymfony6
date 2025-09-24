<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderProcessorInterface;
use Exception;

class OrderPaymentProcessor implements OrderProcessorInterface
{
    /**
     * @throws \Exception
     */
    public function process(OrderStorageInterface $order): void {
        if (!$order->getOrderStoragePayment()) {
            throw new Exception("Payment method not set.");
        }
        if ($order->getOrderStorageTotal() <= 0) {
            throw new Exception("Order total must be greater than zero.");
        }
    }

}