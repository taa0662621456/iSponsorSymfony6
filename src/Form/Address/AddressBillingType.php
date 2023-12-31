<?php

namespace App\Form\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class AddressBillingType extends AbstractType
{
    protected string $dataClass;

    public function __construct(string $dataClass = 'data_class')
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('countryCode', AddressCountryCodeCollectionType::class, [
                'label' => 'form.channel.billing_data.country',
                'enabled' => true,
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => 'form.channel.billing_data.street',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'form.channel.billing_data.city',
                'required' => false,
            ])
            ->add('postcode', TextType::class, [
                'label' => 'form.channel.billing_data.postcode',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', $this->dataClass);
    }
}
