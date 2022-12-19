<?php

namespace App\Service\Promotion;


final class PromotionCouponUsageLimitEligibilityChecker implements PromotionCouponEligibilityCheckerInterface
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionCouponInterface $promotionCoupon): bool
    {
        $usageLimit = $promotionCoupon->getUsageLimit();

        return $usageLimit === null || $promotionCoupon->getUsed() < $usageLimit;
    }
}
