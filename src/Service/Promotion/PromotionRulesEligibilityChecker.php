<?php

namespace App\Service\Promotion;

final class PromotionRulesEligibilityChecker implements PromotionEligibilityCheckerInterface
{
    public function __construct(private ServiceRegistryInterface $ruleRegistry)
    {
    }

    public function isEligible(PromotionSubjectInterface $promotionSubject, PromotionInterface $promotion): bool
    {
        if (!$promotion->hasRules()) {
            return true;
        }

        foreach ($promotion->getRules() as $rule) {
            if (!$this->isEligibleToRule($promotionSubject, $rule)) {
                return false;
            }
        }

        return true;
    }

    private function isEligibleToRule(PromotionSubjectInterface $subject, PromotionRuleInterface $rule): bool
    {
        /** @var RuleCheckerInterface $checker */
        $checker = $this->ruleRegistry->get($rule->getType());

        return $checker->isEligible($subject, $rule->getConfiguration());
    }
}
