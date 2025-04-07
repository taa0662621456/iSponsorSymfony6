<?php

namespace App\Service\Currency;

use Symfony\Component\Validator\Constraint;

class DifferentSourceTargetCurrency extends Constraint
{
    /** @var string */
    public string $message = 'exchange_rate.different_source_target_currency';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
