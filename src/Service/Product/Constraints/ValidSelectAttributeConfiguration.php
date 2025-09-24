<?php

namespace App\Service\Product\Constraints;

use Symfony\Component\Validator\Constraint;

final class ValidSelectAttributeConfiguration extends Constraint
{
    public string $messageMultiple = 'attribute.configuration.multiple';

    public string $messageMinEntries = 'attribute.configuration.min_entries';

    public string $messageMaxEntries = 'attribute.configuration.max_entries';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return 'valid_select_attribute_validator';
    }
}