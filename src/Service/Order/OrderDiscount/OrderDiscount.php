<?php

namespace App\Service\Order\OrderDiscount;

use App\EntityInterface\Order\OrderStorageInterface;

class OrderDiscount
{

    private array $discountRules;

    public function __construct(array $discountRules) {
        $this->discountRules = $discountRules;
    }

    public function getApplicableDiscounts(OrderStorageInterface $order): array {
        $applicableDiscounts = [];
        foreach ($this->discountRules as $rule) {
            if ($rule->isApplicable($order)) {
                $applicableDiscounts[] = $rule;
            }
        }
        return $applicableDiscounts;
    }

}
