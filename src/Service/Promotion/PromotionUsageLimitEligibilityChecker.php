<?php

namespace App\Service\Promotion;


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
