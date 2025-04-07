<?php


namespace App\Extension;



use App\EventSubscriber\AddUserFormSubscriber;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

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
