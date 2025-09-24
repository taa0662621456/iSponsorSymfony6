<?php

namespace App\Service\Shipment;


final class ShipmentCategoryEligibilityChecker
{
    public const CATEGORY_REQUIREMENT_MATCH_NONE = 0;

    public const CATEGORY_REQUIREMENT_MATCH_ANY = 1;

    public const CATEGORY_REQUIREMENT_MATCH_ALL = 2;

    public function isEligible($shippingSubject, $shippingMethod): bool
    {
        if (!$category = $shippingMethod->getCategory()) {
            return true;
        }

        $numMatches = $numShippables = 0;
        foreach ($shippingSubject->getShippables() as $shippable) {
            ++$numShippables;
            if ($category === $shippable->getShippingCategory()) {
                ++$numMatches;
            }
        }

        return match ($shippingMethod->getCategoryRequirement()) {
            self::CATEGORY_REQUIREMENT_MATCH_NONE => 0 === $numMatches,
            self::CATEGORY_REQUIREMENT_MATCH_ANY => 0 < $numMatches,
            self::CATEGORY_REQUIREMENT_MATCH_ALL => $numShippables === $numMatches,
            default => false,
        };
    }
}