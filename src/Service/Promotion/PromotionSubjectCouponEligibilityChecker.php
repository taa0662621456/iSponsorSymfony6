<?php

namespace App\Service\Promotion;

final class PromotionSubjectCouponEligibilityChecker implements PromotionEligibilityCheckerInterface
{
    public function __construct(private PromotionCouponEligibilityCheckerInterface $promotionCouponEligibilityChecker)
    {
    }

    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionInterface $promotion): bool
    {
        if (!$promotion->isCouponBased()) {
            return true;
        }

        if (!$promotionSubject instanceof PromotionCouponAwarePromotionSubjectInterface) {
            return false;
        }

        $promotionCoupon = $promotionSubject->getPromotionCoupon();
        if (null === $promotionCoupon) {
            return false;
        }

        if ($promotion !== $promotionCoupon->getPromotion()) {
            return false;
        }

        return $this->promotionCouponEligibilityChecker->isEligible($promotionSubject, $promotionCoupon);
    }
}
