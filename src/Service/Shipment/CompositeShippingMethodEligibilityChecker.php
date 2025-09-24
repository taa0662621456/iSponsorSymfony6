<?php

namespace App\Service\Shipment;

use Webmozart\Assert\Assert;

final class CompositeShippingMethodEligibilityChecker
{
    private array $eligibilityCheckers;

    /**
     * @param array $eligibilityCheckers
     */
    public function __construct(array $eligibilityCheckers)
    {
//        Assert::allIsInstanceOf($eligibilityCheckers, ShippingMethodEligibilityCheckerInterface::class);

        $this->eligibilityCheckers = $eligibilityCheckers;
    }

    public function isEligible($shippingSubject, $shippingMethod): bool
    {
        foreach ($this->eligibilityCheckers as $eligibilityChecker) {
            if (!$eligibilityChecker->isEligible($shippingSubject, $shippingMethod)) {
                return false;
            }
        }

        return true;
    }
}