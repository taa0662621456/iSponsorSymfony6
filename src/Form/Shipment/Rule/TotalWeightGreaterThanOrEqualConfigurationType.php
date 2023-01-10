<?php


namespace App\Form\Shipment\Rule;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class TotalWeightGreaterThanOrEqualConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'weight',
            NumberType::class,
            [
                'label' => 'form.shipping_method_rule.weight',
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Type(['type' => 'numeric', 'groups' => ['isponsor']]),
                    new GreaterThan(['value' => 0, 'groups' => ['isponsor']]),
                ],
            ],
        );
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_rule_total_weight_greater_than_or_equal_configuration';
    }
}
