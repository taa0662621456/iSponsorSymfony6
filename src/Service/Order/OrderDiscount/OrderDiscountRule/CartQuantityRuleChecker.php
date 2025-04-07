<?php

namespace App\Service\Order\OrderDiscount\OrderDiscountRule;

use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\PromotionSubjectInterface;
use App\ServiceInterface\Order\OrderDiscount\OrderDiscountRule\RuleCheckerInterface;

final class CartQuantityRuleChecker implements RuleCheckerInterface
{
    public const TYPE = 'cart_quantity';

    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool
    {
        if (!$subject instanceof CountablePromotionSubjectInterface) {
            return false;
        }

        return $subject->getPromotionSubjectCount() >= $configuration['count'];
    }
}
