<?php

namespace App\Service\Shipment;

final class ShippingMethodRulesEligibilityChecker
{
    public function __construct(private ServiceRegistryInterface $ruleRegistry)
    {
    }

    public function isEligible(ShippingSubjectInterface $shippingSubject, ShippingMethodInterface $shippingMethod): bool
    {
        if (!$shippingMethod->hasRules()) {
            return true;
        }

        foreach ($shippingMethod->getRules() as $rule) {
            if (!$this->isEligibleToRule($shippingSubject, $rule)) {
                return false;
            }
        }

        return true;
    }

    private function isEligibleToRule(ShippingSubjectInterface $subject, ShippingMethodRuleInterface $rule): bool
    {
        /** @var RuleCheckerInterface $checker */
        $checker = $this->ruleRegistry->get($rule->getType());

        return $checker->isEligible($subject, $rule->getConfiguration());
    }
}
