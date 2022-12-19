<?php


namespace App\Form\Type\Calculator;


use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;

final class PerUnitRateConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'label' => 'form.shipping_calculator.per_unit_rate_configuration.amount',
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Range(['min' => 0, 'minMessage' => 'shipping_method.calculator.min', 'groups' => ['isponsor']]),
                    new Type(['type' => 'integer', 'groups' => ['isponsor']]),
                ],
                'currency' => $options['currency'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => null,
            ])
            ->setRequired('currency')
            ->setAllowedTypes('currency', 'string')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_calculator_per_unit_rate';
    }
}
