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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

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
				'required'        => false,
				'constraints'     => [
                    new NotBlank([
                        'message' => 'Пожалуйста введите email',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your email should be at least {{ limit }} characters',
                        'max' => 32,
                    ]),
                ],
				'attr'            => [
					'id'          => 'email',
					'name'        => '_email',
					'class'       => 'form-control m-1',
					'placeholder' => 'vendor.placeholder.email',
					'tabindex'    => '101',
					'required'    => null,
					//'autofocus' => true
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => true,
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
						'tabindex'    => '201',
                        'required'    => null,
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
						'tabindex'    => '202',
                        'required'    => null,
                    ]
                ],
                'required' => true,
                'attr' => [
                    'id' => 'password',
                    'name' => '_password',
                    'class' =>'form-control m-1',
                    'placeholder' => 'Password',
					'tabindex' => '203',
                    'required'    => null,
                    'autocomplete' => 'new-password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                     ]),
//                    new UserPassword([
//                        'message' => 'Какое-то сообщение о пароле',
//                    ]),
                    new NotCompromisedPassword([
                        'message' => 'vendor.password.not.compromised',
                    ])
                ],
            ])
            ->add('phone', TelType::class, [
                'help' => 'vendor.phone.must.be.formatted',
                'invalid_message' => 'vendor.phone.invalid',
                'empty_data' => '000000000000',
                'label' => 'vendor.label.phone',
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'attr' => [
                    'class' =>'form-control m-1',
                    'placeholder' => 'vendor.placeholder.phone',
                    'required'    => null,
                ],
                'constraints' => [
                    # TODO: нужен валидатор телефона
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'vendor.term.agree',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Вы соглашаетесь с условиями.',
                    ]),
//                    new IsFalse([
//                        'message' => 'Вы соглашаетесь с условиями?'
//                    ])
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'required'    => null,
//                    'class'       => 'form-check-input',
                ]
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
