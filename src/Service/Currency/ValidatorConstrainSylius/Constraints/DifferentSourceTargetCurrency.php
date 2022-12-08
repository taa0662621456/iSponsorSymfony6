<?php


namespace App\CurrencyBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class DifferentSourceTargetCurrency extends Constraint
{
    /** @var string */
    public $message = 'exchange_rate.different_source_target_currency';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
