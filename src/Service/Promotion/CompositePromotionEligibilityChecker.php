<?php

namespace App\Service\Promotion;

use App\EntityInterface\Promotion\PromotionInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;
use Webmozart\Assert\Assert;

final class CompositePromotionEligibilityChecker implements PromotionEligibilityCheckerInterface
{
    /** @var PromotionEligibilityCheckerInterface[] */
    private array $promotionEligibilityCheckers;

    /**
     * @param PromotionEligibilityCheckerInterface[] $promotionEligibilityCheckers
     */
    public function __construct(array $promotionEligibilityCheckers)
    {
        Assert::notEmpty($promotionEligibilityCheckers);
        Assert::allIsInstanceOf($promotionEligibilityCheckers, PromotionEligibilityCheckerInterface::class);

        $this->promotionEligibilityCheckers = $promotionEligibilityCheckers;
    }

    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionInterface $promotion): bool
    {
        foreach ($this->promotionEligibilityCheckers as $promotionEligibilityChecker) {
            if (!$promotionEligibilityChecker->isEligible($promotionSubject, $promotion)) {
                return false;
            }
        }

        return true;
    }
}
