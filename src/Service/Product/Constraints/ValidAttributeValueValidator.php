<?php

namespace App\Service\Product\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class ValidAttributeValueValidator extends ConstraintValidator
{
    public function __construct()
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$value instanceof AttributeValueInterface) {
            throw new UnexpectedTypeException($value::class, AttributeValueInterface::class);
        }

        /** @var AttributeTypeInterface $attributeType */
        $attributeType = $this->attributeTypeRegistry->get($value->getType());

        $attributeType->validate($value, $this->context, $value->getAttribute()->getConfiguration());
    }
}
