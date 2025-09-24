<?php


namespace App\Extension;



final class CustomerTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventSubscriber(new AddUserFormSubscriber(ShopUserType::class));
    }

    public function getExtendedType(): string
    {
        return CustomerType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [CustomerType::class];
    }
}