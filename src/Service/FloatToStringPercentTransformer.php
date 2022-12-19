<?php

namespace App\Service;

use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\DataTransformer\PercentToLocalizedStringTransformer;

final class FloatToStringPercentTransformer extends PercentToLocalizedStringTransformer
{
    /**
     * Transforms between a percentage value into a float
     *
     * @param string $value Percentage value
     *
     * @return float Normalized value
     *
     * @throws TransformationFailedException if the given value is not a string or
     *                                       if the value could not be transformed
     */
    public function reverseTransform(mixed $value): int|float|null
    {
        if (!is_numeric($value)) {
            return null;
        }

        return (float) parent::reverseTransform($value);
    }

    /**
     * @param float|string $value
     */
    public function transform(mixed $value): string
    {
        if (!is_numeric($value)) {
            return '';
        }

        return parent::transform((float) $value);
    }
}
