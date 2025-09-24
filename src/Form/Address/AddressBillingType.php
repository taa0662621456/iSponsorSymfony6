<?php

namespace App\Form\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressBillingType extends AbstractType
{
    public function __construct(private readonly string $dataClass)
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', $this->dataClass);
    }
}