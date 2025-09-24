<?php

namespace App\Service\Currency;

use Symfony\Component\Validator\Constraint;

class UniqueCurrencyPair extends Constraint
{
    /** @var string */
    public string $message = 'exchange_rate.unique_currency_pair';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}