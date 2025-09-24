<?php

namespace App\Service\Money;

use Symfony\Component\Form\Extension\Core\DataTransformer\MoneyToLocalizedStringTransformer;

final class MoneyTransformer extends MoneyToLocalizedStringTransformer
{
    /** @psalm-suppress ImplementedReturnTypeMismatch Parent class from Symfony returns null but does not include it in the docblock */
    public function reverseTransform($value): ?int
    {
        /** @var int|float|null $value */
        $value = parent::reverseTransform($value);

        return null === $value ? null : (int) round($value);
    }
}