<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class VendorSecurityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('email', EmailType::class, [
				'invalid_message' => 'The email address is invalid.',
				'label'           => 'vendor.label.email',
				'label_attr'      => [
					'class' => 'sr-only',
					'value' => 'last_username'
                ],
				'required'        => true,
				'attr'            => [
					'id'          => 'email',
					'name'        => '_email',
					'class'       => 'form-control m-1',
					'placeholder' => 'vendor.placeholder.email',
					'tabindex'    => '101',
					//'autofocus' => true
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
				'invalid_message' => 'The password is invalid.',
				'type'            => PasswordType::class,
				'first_options'   => [
					'label'      => 'vendor.label.password',
					'label_attr' => [
						'class' => 'sr-only',
                    ],
					'attr'       => [
						'class'       => 'form-control m-1',
						'placeholder' => 'vendor.placeholder.password',
						'tabindex'    => '201'
                    ]
                ],
                'second_options' => [
                    'required' => true,
					'label'      => 'vendor.label.password.confirm',
					'label_attr' => [
						'class' => 'sr-only'
                    ],
					'attr'       => [
						'class'       => 'form-control m-1',
						'placeholder' => 'vendor.placeholder.password.confirm',
						'tabindex'    => '202'
                    ]
                ],
                'required' => false,
                'attr' => [
                    'id' => 'password',
                    'name' => '_password',
                    'class' =>'form-control m-1',
                    'placeholder' => 'Password',
					'tabindex' => '203',
                    'autocomplete' => 'new-password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                     ]),
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'vendor.label.phone',
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'attr' => [
                    'class' =>'form-control m-1',
                    'placeholder' => 'vendor.placeholder.phone'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Вы соглашаетесь с условиями.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => VendorSecurity::class,
			'translation_domain' => 'vendor'
		]);
    }
}
