<?php


namespace App\CurrencyBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueCurrencyPair extends Constraint
{
    /** @var string */
    public $message = 'exchange_rate.unique_currency_pair';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
