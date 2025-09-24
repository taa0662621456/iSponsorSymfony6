<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderProcessorInterface;

class OrderTaxCalculateProcessor implements OrderProcessorInterface
{

    public function process(OrderStorageInterface $order): void {
        $orderTaxAmount = 0;
        foreach ($order->getOrderItem() as $item) {
            // TaxationInterface $taxation
            // Cюда мы должны подключить отдельно сущность таксов
            // $orderTaxAmount += $this->taxCalculator->calculateTax($item);
        }
        $order->setOrderStorageBillTaxAmount($orderTaxAmount);
    }
}