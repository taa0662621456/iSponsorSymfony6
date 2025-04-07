<?php

namespace App\Service\Promotion;

use App\EntityInterface\Promotion\PromotionInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;

final class PromotionUsageLimitEligibilityChecker
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionInterface $promotion): bool
    {
        if (null === $usageLimit = $promotion->getUsageLimit()) {
            return true;
        }

        return $promotion->getUsed() < $usageLimit;
    }
}
