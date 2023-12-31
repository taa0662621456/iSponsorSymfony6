<?php

namespace App\Service\Discount\Rule;

use App\EntityInterface\Order\OrderStorageInterface;

class PercentageDiscountRuleChecker
{
    private float $percentage;

    public function __construct(float $percentage) {
        $this->percentage = $percentage;
    }

    public function isApplicable(OrderStorageInterface $order): bool {
        // Логика для определения, применима ли скидка
        return true; // Пример, здесь должна быть ваша бизнес-логика
    }

    public function applyDiscount(OrderStorageInterface $order): void {
        $discountAmount = $order->getOrderTotal() * ($this->percentage / 100);
        $order->setDiscount($discountAmount);
    }

}
