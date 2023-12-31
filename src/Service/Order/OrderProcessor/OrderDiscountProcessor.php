<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderProcessorInterface;

class OrderDiscountProcessor implements OrderProcessorInterface
{
    public function process(OrderStorageInterface $order): void {
        $discounts = $this->discountService->getApplicableDiscounts($order);
        foreach ($discounts as $discount) {
            $order->applyDiscount($discount);
        }
    }


}
