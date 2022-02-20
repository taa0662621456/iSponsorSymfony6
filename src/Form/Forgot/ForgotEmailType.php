<?php

namespace App\Form\Forgot;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgotEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone', TelType::class, [
                'invalid_message' => 'vendor.phone.invalid',
                'empty_data' => '000000000000',
                'label' => 'vendor.label.phone',
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'attr' => [
                    'class' =>'',
                    'minlength' => 8,
                    'maxlength' => 20,
                    'pattern' => '\+?[0-9\s\-\(\)]+',
                    'placeholder' => 'vendor.placeholder.phone',
                    'required'    => null,
                ],
                'constraints' => [
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VendorSecurity::class,
            'translation_domain' => 'security',
            'validation_groups' => false,
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}
