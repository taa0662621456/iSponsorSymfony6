<?php

namespace App\Service;

use Symfony\Component\Form\Extension\Core\DataTransformer\MoneyToLocalizedStringTransformer;

final class IntToStringMoneyTransformer extends MoneyToLocalizedStringTransformer
{
    public function reverseTransform(mixed $value): int|float|null
    {
        if (!is_numeric($value)) {
            return null;
        }

        return (int) parent::reverseTransform($value);
    }

    public function transform(mixed $value): string
    {
        if (!is_numeric($value)) {
            return '';
        }

        return parent::transform($value);
    }
}