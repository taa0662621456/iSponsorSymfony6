<?php

namespace App\Service\Taxation;




final class TaxEligibilityChecker
{
    public function __construct(
        protected $calendar,
    ) {
    }

    public function isEligible($taxRate): bool
    {
        $date = $this->calendar->now();
        $startDate = $taxRate->getStartDate();
        $endDate = $taxRate->getEndDate();

        return (null === $startDate || $startDate <= $date) && (null === $endDate || $endDate >= $date);
    }
}
