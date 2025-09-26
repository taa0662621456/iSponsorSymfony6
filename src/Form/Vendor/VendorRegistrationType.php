<?php


namespace App\Form\Vendor;
use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class VendorRegistrationType extends AbstractType
{
    public function __construct(private readonly string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('email', EmailType::class, [
				'invalid_message' => 'The email address is invalid.',
				'label'           => 'vendor.label.email',
				'label_attr'      => [
					'class' => '',
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
					'class'       => 'mb-2',
					'placeholder' => 'vendor.placeholder.email',
					'tabindex'    => '101',
					'required'    => null,
					//'autofocus' => true
                ],
                    ]
            )
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => true,
				'invalid_message' => 'The password is invalid. Passwords must match',
				'type'            => PasswordType::class,
				'first_options'   => [
					'label'      => 'vendor.label.password',
					'label_attr' => [
						'class' => 'plainPassword',
                    ],
					'attr'       => [
						'class'       => 'rounded-0 mb-2',
						'placeholder' => 'vendor.placeholder.password',
						'tabindex'    => '201',
                        'required'    => null,
                    ]
                ],
                'second_options' => [
                    'required' => true,
					'label'      => 'vendor.label.password.confirm',
					'label_attr' => [
						'class' => ''
                    ],
					'attr'       => [
						'class'       => 'rounded-0 mb-2 confirmPassword',
						'placeholder' => 'vendor.placeholder.password.confirm',
						'tabindex'    => '202',
                        'required'    => null,
                    ]
                ],
                'required' => true,
                'attr' => [
                    'id' => 'password',
                    'name' => '_password',
                    'class' =>'r-0 password-field',
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
            ]
            )
            ->add('phone', TelType::class, [
//                'help' => 'vendor.phone.must.be.formatted', //TODO: phone must be formatted
                'invalid_message' => 'vendor.phone.invalid',
                'empty_data' => '000000000000',
                'label' => 'vendor.label.phone',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' =>'rounded-0 rounded-bottom',
                    'minlength' => 8,
                    'maxlength' => 20,
                    'pattern' => '\+?[0-9\s\-\(\)]+',
                    'placeholder' => 'vendor.placeholder.phone',
                    'required'    => null,
                ],
                'constraints' => [
                ]
            ]
            )
            ->add('show_me_password', CheckboxType::class, [
                'mapped'     => false,
                'required'   => false,
                'translation_domain' => 'button',
                'label' => 'button.label.show.password',
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr'       => [
                    'id'    => 'show_me_password',
                    'name'  => 'show_me_password',
                    'class' => 'text-left mb-3 show_me_password d-inline-block',
//                    'onclick' => 'showMePassword()'
                ],
            ]
            )
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'vendor.term.agree',
                'constraints' => [
                    new IsTrue([
                        'message' => 'vendor.term.agree.notice',
                    ]),
                    new IsFalse([
                        'message' => 'vendor.term.agree.ask'
                    ])
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'required'    => null,
                    'class'       => 'form-check-input d-inline-block',
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => VendorSecurity::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => $this->token,
			'translation_domain' => 'vendor',
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ],
            'empty_data' => function (FormInterface $form) {
                return new VendorSecurity($form->get('title')->getData());
            },
		]);
    }
}
