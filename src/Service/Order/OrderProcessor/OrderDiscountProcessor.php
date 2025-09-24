<?php

namespace App\Service\Order\OrderProcessor;

use App\ServiceInterface\Order\OrderProcessorInterface;

/**
 * @property $discountService
 */
class OrderDiscountProcessor implements OrderProcessorInterface
{
    public function process(OrderStorage $order): void {
        $discounts = $this->discountService->getApplicableDiscounts($order);
        foreach ($discounts as $discount) {
            $order->applyDiscount($discount);
        }
    }


}
