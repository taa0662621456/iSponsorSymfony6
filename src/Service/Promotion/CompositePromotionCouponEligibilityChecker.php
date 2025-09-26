<?php

namespace App\Service\Promotion;

use Webmozart\Assert\Assert;

final class CompositePromotionCouponEligibilityChecker implements PromotionCouponEligibilityCheckerInterface
{
    /** @var PromotionCouponEligibilityCheckerInterface[] */
    private array $promotionCouponEligibilityCheckers;

    /**
     * @param PromotionCouponEligibilityCheckerInterface[] $promotionCouponEligibilityCheckers
     */
    public function __construct(array $promotionCouponEligibilityCheckers)
    {
        Assert::notEmpty($promotionCouponEligibilityCheckers);
        Assert::allIsInstanceOf($promotionCouponEligibilityCheckers, PromotionCouponEligibilityCheckerInterface::class);

        $this->promotionCouponEligibilityCheckers = $promotionCouponEligibilityCheckers;
    }

    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionCouponInterface $promotionCoupon): bool
    {
        foreach ($this->promotionCouponEligibilityCheckers as $promotionCouponEligibilityChecker) {
            if (!$promotionCouponEligibilityChecker->isEligible($promotionSubject, $promotionCoupon)) {
                return false;
            }
        }

        return true;
    }
}
