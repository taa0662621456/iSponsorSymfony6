<?php


namespace App\Extension;



final class ShippingMethodTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zone', ZoneChoiceType::class, [
                'label' => 'form.shipping_method.zone',
                'zone_scope' => Scope::SHIPPING,
            ])
            ->add('taxCategory', TaxCategoryChoiceType::class, [
                'required' => false,
                'placeholder' => '---',
                'label' => 'form.shipping_method.tax_category',
            ])
            ->add('channels', ChannelChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'label' => 'form.shipping_method.channels',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return ShippingMethodType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ShippingMethodType::class];
    }
}
