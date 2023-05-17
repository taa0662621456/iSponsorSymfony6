<?php

namespace App\Service\Product\Constraints;

use App\Interface\ServiceRegistryInterface;
use Symfony\Component\Validator\ConstraintValidator;

final class ValidAttributeValueValidator extends ConstraintValidator
{
    public function __construct(private readonly ServiceRegistryInterface $attributeTypeRegistry)
    {
    }

    public function validate($value, \Symfony\Component\Validator\Constraint $constraint): void
    {
        if (!$value instanceof AttributeValueInterface) {
            throw new UnexpectedTypeException($value::class, AttributeValueInterface::class);
        }

        /** @var AttributeTypeInterface $attributeType */
        $attributeType = $this->attributeTypeRegistry->get($value->getType());

        $attributeType->validate($value, $this->context, $value->getAttribute()->getConfiguration());
    }
}
