<?php


namespace App\CoreBundle\Form\Extension;



final class ChannelTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('locales', LocaleChoiceType::class, [
                'label' => 'form.channel.locales',
                'required' => false,
                'multiple' => true,
            ])
            ->add('defaultLocale', LocaleChoiceType::class, [
                'label' => 'form.channel.locale_default',
                'required' => true,
                'placeholder' => null,
            ])
            ->add('currencies', CurrencyChoiceType::class, [
                'label' => 'form.channel.currencies',
                'required' => false,
                'multiple' => true,
            ])
            ->add('countries', CountryChoiceType::class, [
                'label' => 'form.channel.countries',
                'required' => false,
                'multiple' => true,
            ])
            ->add('defaultTaxZone', ZoneChoiceType::class, [
                'required' => false,
                'label' => 'form.channel.tax_zone_default',
                'zone_scope' => Scope::TAX,
            ])
            ->add('taxCalculationStrategy', TaxCalculationStrategyChoiceType::class, [
                'label' => 'form.channel.tax_calculation_strategy',
            ])
            ->add('themeName', ThemeNameChoiceType::class, [
                'label' => 'form.channel.theme',
                'required' => false,
                'empty_data' => null,
                'placeholder' => 'ui.no_theme',
            ])
            ->add('contactEmail', EmailType::class, [
                'label' => 'form.channel.contact_email',
                'required' => false,
            ])
            ->add('contactPhoneNumber', TextType::class, [
                'required' => false,
                'label' => 'form.channel.contact_phone_number',
            ])
            ->add('skippingShippingStepAllowed', CheckboxType::class, [
                'label' => 'form.channel.skipping_shipping_step_allowed',
                'required' => false,
            ])
            ->add('skippingPaymentStepAllowed', CheckboxType::class, [
                'label' => 'form.channel.skipping_payment_step_allowed',
                'required' => false,
            ])
            ->add('accountVerificationRequired', CheckboxType::class, [
                'label' => 'form.channel.account_verification_required',
                'required' => false,
            ])
            ->add('shippingAddressInCheckoutRequired', CheckboxType::class, [
                'label' => 'form.channel.shipping_address_in_checkout_required',
                'required' => false,
            ])
            ->add('shopBillingData', ShopBillingDataType::class, [
                'label' => 'form.channel.shop_billing_data',
            ])
            ->add('menuTaxon', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.channel.menu_taxon',
            ])
            ->addEventSubscriber(new AddBaseCurrencySubscriber())
            ->addEventSubscriber(new ChannelFormSubscriber())
        ;
    }

    public function getExtendedType(): string
    {
        return ChannelType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ChannelType::class];
    }
}
