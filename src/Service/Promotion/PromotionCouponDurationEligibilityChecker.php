<?php

namespace App\Service\Promotion;

use App\EntityInterface\Promotion\PromotionCouponInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;
use DateTime;

final class PromotionCouponDurationEligibilityChecker implements PromotionCouponEligibilityCheckerInterface
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionCouponInterface $promotionCoupon): bool
    {
        $endsAt = $promotionCoupon->getExpiresAt();

        return null === $endsAt || new DateTime() < $endsAt;
    }
}
