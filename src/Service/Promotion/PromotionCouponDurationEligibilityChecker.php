<?php

namespace App\Service\Promotion;

final class PromotionCouponDurationEligibilityChecker implements PromotionCouponEligibilityCheckerInterface
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionCouponInterface $promotionCoupon): bool
    {
        $endsAt = $promotionCoupon->getExpiresAt();

        return $endsAt === null || new \DateTime() < $endsAt;
    }
}