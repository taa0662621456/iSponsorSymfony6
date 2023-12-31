<?php

namespace App\Service\Taxation;

final class DefaultTaxCalculator
{
    public function calculate(float $base, $rate): float
    {
        if ($rate->isIncludedInPrice()) {
            return round($base - ($base / (1 + $rate->getAmount())));
        }

        return round($base * $rate->getAmount());
    }
}
