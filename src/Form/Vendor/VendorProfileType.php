<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class VendorProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vendorName', TextType::class, ['label' => 'vendorName'])
            ->add('email', EmailType::class, ['label' => 'email'])
            ->add('password', PasswordType::class, ['label' => 'password'])
            ->add('vendorFirstName', TextType::class, ['label' => 'vendorFirstName'])
            ->add('vendorLastName', TextType::class, ['label' => 'vendorLastName'])
            ->add('vendorMiddleName', TextType::class, ['label' => 'vendorMiddleName'])
            ->add('vendorPhone')
            ->add('vendorSecondPhone')
            ->add('vendorFax')
            ->add('vendorAddress')
            ->add('vendorSecondAddress')
            ->add('vendorCity')
            ->add('vendorStateId')
            ->add('vendorCountryId')
            ->add('vendorZip')
            ->add('sendEmail', EmailType::class, ['label' => 'sendEmail'])
            ->add('registerDate')
            ->add('lastRequestDate')
            ->add('lastResetTime')
            ->add('resetCount');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendor::class,
            'translation_domain' => 'vendor',
        ]);
    }
}