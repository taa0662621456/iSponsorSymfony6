<?php

namespace App\Service\Product\Constraints;

use Webmozart\Assert\Assert;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Form\Product\AttributeType\TextAttributeType;

final class ValidTextAttributeConfigurationValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /* @var AttributeInterface $value */
        Assert::isInstanceOf($value, AttributeInterface::class);

        /* @var ValidTextAttributeConfiguration $constraint */
        Assert::isInstanceOf($constraint, ValidTextAttributeConfiguration::class);

        if (TextAttributeType::TYPE !== $value->getType()) {
            return;
        }

        $configuration = $value->getConfiguration();

        $min = null;
        if (!empty($configuration['min'])) {
            $min = $configuration['min'];
        }

        $max = null;
        if (!empty($configuration['max'])) {
            $max = $configuration['max'];
        }

        if (null !== $min && null !== $max && $min > $max) {
            $this->context->addViolation($constraint->message);
        }
    }
}