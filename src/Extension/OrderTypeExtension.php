<?php


namespace App\CoreBundle\Form\Extension;



final class OrderTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('shippingAddress', AddressType::class)
            ->add('billingAddress', AddressType::class)
        ;
    }

    public function getExtendedType(): string
    {
        return OrderType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [OrderType::class];
    }
}
