<?php

namespace App\Form\Customer;

use Symfony\Component\Form\AbstractType;
use App\Form\Address\AddressSelectorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerDefaultAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('defaultAddress', AddressSelectorType::class, [
                'customer' => $options['customer'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('customer');
    }

    public function getBlockPrefix(): string
    {
        return 'customer_default_address';
    }
}
