<?php


namespace App\AttributeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

final class ValidTextAttributeConfiguration extends Constraint
{
    public string $message = 'attribute.configuration.max_length';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return 'valid_text_attribute_validator';
    }
}
