<?php

namespace App\Service\Promotion;

use App\EntityInterface\Promotion\PromotionCouponInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;

final class PromotionCouponUsageLimitEligibilityChecker implements PromotionCouponEligibilityCheckerInterface
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionCouponInterface $promotionCoupon): bool
    {
        $usageLimit = $promotionCoupon->getUsageLimit();

        return null === $usageLimit || $promotionCoupon->getUsed() < $usageLimit;
    }
}
