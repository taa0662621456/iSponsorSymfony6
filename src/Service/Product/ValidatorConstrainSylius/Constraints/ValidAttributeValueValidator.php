<?php

namespace App\Service\Product\ValidatorConstrainSylius\Constraints;

final class ValidAttributeValueValidator extends ConstraintValidator
{
    public function __construct(private readonly ServiceRegistryInterface $attributeTypeRegistry)
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
