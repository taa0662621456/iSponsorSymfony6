<?php


namespace App\Extension;



use Symfony\Component\Form\AbstractTypeExtension;

final class CustomerTypeExtension extends AbstractTypeExtension
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options): void
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
