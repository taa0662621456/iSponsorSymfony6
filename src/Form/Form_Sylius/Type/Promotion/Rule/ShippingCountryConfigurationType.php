<?php


namespace App\CoreBundle\Form\Type\Promotion\Rule;



final class ShippingCountryConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', CountryCodeChoiceType::class, [
                'label' => 'form.promotion_rule.shipping_country_configuration.country',
                'placeholder' => 'form.country.select',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_shipping_country_configuration';
    }
}
