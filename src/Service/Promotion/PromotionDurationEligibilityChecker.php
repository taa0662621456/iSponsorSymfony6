<?php

namespace App\Service\Promotion;

use App\EntityInterface\Promotion\PromotionInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;
use DateTime;

final class PromotionDurationEligibilityChecker implements PromotionEligibilityCheckerInterface
{
    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionInterface $promotion): bool
    {
        $now = new DateTime();

        $startsAt = $promotion->getStartsAt();
        if (null !== $startsAt && $now < $startsAt) {
            return false;
        }

        $endsAt = $promotion->getEndsAt();
        if (null !== $endsAt && $now > $endsAt) {
            return false;
        }

        return true;
    }
}
