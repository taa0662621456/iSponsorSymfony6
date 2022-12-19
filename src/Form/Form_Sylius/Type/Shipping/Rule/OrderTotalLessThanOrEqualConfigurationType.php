<?php


namespace App\CoreBundle\Form\Type\Shipping\Rule;


use Symfony\Component\OptionsResolver\OptionsResolver;

final class OrderTotalLessThanOrEqualConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'label' => 'form.shipping_method_rule.amount',
                'currency' => $options['currency'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('currency')
            ->setAllowedTypes('currency', 'string')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_rule_order_total_less_than_or_equal_configuration';
    }
}
