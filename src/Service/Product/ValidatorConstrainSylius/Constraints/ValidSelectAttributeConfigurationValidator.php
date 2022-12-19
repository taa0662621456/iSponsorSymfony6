<?php


namespace App\AttributeBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class ValidSelectAttributeConfigurationValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /** @var AttributeInterface $value */
        Assert::isInstanceOf($value, AttributeInterface::class);

        /** @var ValidSelectAttributeConfiguration $constraint */
        Assert::isInstanceOf($constraint, ValidSelectAttributeConfiguration::class);

        if (SelectAttributeType::TYPE !== $value->getType()) {
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

        if (null === $min && null === $max) {
            return;
        }

        $multiple = $value->getConfiguration()['multiple'];
        if (!$multiple) {
            $this->context->addViolation($constraint->messageMultiple);

            return;
        }

        if (null !== $min && null !== $max && $min > $max) {
            $this->context->addViolation($constraint->messageMaxEntries);

            return;
        }

        $numberOfChoices = count($value->getConfiguration()['choices']);
        if (null !== $min && $min > $numberOfChoices) {
            $this->context->addViolation($constraint->messageMinEntries);
        }
    }
}
