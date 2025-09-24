<?php

namespace App\Form\Forgot;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ForgotPhoneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'invalid_message' => 'forgot.email.invalid',
                'label'           => 'forgot.email.label',
                'label_attr'      => [
                    'class' => 'sr-only',
                    'value' => 'last_username'
                ],
                'required'        => false,
                'constraints'     => [
                    new NotBlank([
                        'message' => 'Пожалуйста введите email Вашей учетной записи',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Your email should be at least {{ limit }} characters',
                        'max' => 64,
                    ]),
                ],
                'attr'            => [
                    'id'          => 'email',
                    'name'        => '_email',
                    'class'       => '',
                    'placeholder' => 'forgot.email.placeholder',
                    'tabindex'    => '101',
                    'required'    => null
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VendorSecurity::class,
            'translation_domain' => 'forgot',
            'validation_groups' => false,
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}