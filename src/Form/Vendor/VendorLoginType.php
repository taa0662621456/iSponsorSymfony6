<?php

namespace App\Form\Vendor;

use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\TwoFactorFormRendererInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class VendorLoginType extends AbstractType implements TwoFactorFormRendererInterface
{
    /**
     * VendorLoginType constructor.
     */
    public function __construct(private readonly string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'invalid_message' => 'The email address is invalid.',
                'label'           => 'vendor.label.email',
                'label_attr'      => [
                    'class' => '',
                    'value' => 'last_username'
                ],
                'required'        => true,
                'constraints'     => [
                    new NotBlank([
                        'message' => 'vendor.message.password.please',
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
                    'class'       => '',
                    'placeholder' => 'vendor.placeholder.email',
                    'tabindex'    => '101',
                    'required'    => null,
                    //'autofocus' => true
                ],
                ])
            ->add('password', PasswordType::class, [
                'invalid_message' => 'The password is invalid.',
                'label'           => 'vendor.label.password',
                'label_attr'      => [
                    'class' => ''
                ],
                'required'        => true,
                'attr'            => [
                    'id'          => 'password',
                    'name'        => '_password',
                    'required'    => null,
                    'class'       => 'mb-3',
                    'placeholder' => 'vendor.placeholder.password',
                    'tabindex'    => '203'
                ]
            ])
            ->add('show_me_password', CheckboxType::class, [
                'mapped'     => false,
                'required'   => false,
                'label' => 'Показать пароль',
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr'       => [
                    'id'    => 'vendor_security_vendorSecurity_show_me_password',
                    'name'  => 'show_me_password',
                    'class' => 'text-left mb-3 password',
                ],
            ])
            ->add('remember', CheckboxType::class, [
                'mapped'     => false,
                'translation_domain' => 'button',
                'label'      => 'button.label.remember',
                'required'   => false,
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr'       => [
                    'id'    => 'remember_me',
                    'name'  => '_remember_me',
                    'class' => 'text-left'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.label.authorization',
                'attr'  => [
                    'class' => 'w-100 btn btn-primary btn-block'
                ]
            ])
            ->add(
            $builder
                ->create('group', FormType::class, [
                    'translation_domain' => 'button',
                    'inherit_data' => true,
                    'label' => false,
                    'attr'=> [
                        'class' => 'btn-group m-0'
                    ]
                ])
                ->add('back', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.back',
                        'attr'  => [
                            'class' => 'btn btn-link btn-sm back',
                            'onclick' => 'window.history.back()'
                        ]
                ])
                ->add('registration', ButtonType::class, [
                    'translation_domain' => 'button',
                    'label' => 'button.label.registration',
                    'attr' => [
                        'class' => 'btn btn-link btn-sm signup',
                        'onclick' => 'window.location.href=\'/registration\''
                    ]
                ])
            )
            # Login by Social Network.
            ->add(
                $builder
                    ->create('network', FormType::class, [
                        'translation_domain' => 'button',
                        'inherit_data' => true,
                        'label' => false,
                        'attr'=> [
                            'class' => 'btn-group m-1'
                        ]
                    ])
                    ->add('facebook', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.facebook',
                        'attr'  => [
                            'class' => 'btn btn-link btn-sm back facebook bi bi-facebook',
                            'onclick' => 'window.location.href=\'/connect/facebook\''
                        ]
                    ])
                    ->add('google', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.google',
                        'attr' => [
                            'class' => 'btn btn-link btn-sm signup google bi bi-google',
                            'onclick' => 'window.location.href=\'/connect/google\'',
                        ]
                    ])
            )
            # Login by Social Network. End!
            # Forgot.
            ->add(
                $builder
                    ->create('forgot', FormType::class, [
                        'translation_domain' => 'button',
                        'inherit_data' => true,
                        'label' => false,
                        'attr'=> [
                            'class' => 'btn-group m-1'
                        ]
                    ])
                    ->add('forgot_email', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.forgot.email',
                        'attr'  => [
                            'class' => 'btn btn-link btn-sm forgot',
                            'onclick' => 'window.location.href=\'/forgot/email\''
                        ]
                    ])
                    ->add('forgot_password', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.forgot.password',
                        'attr' => [
                            'class' => 'btn btn-link btn-sm forgot',
                            'onclick' => 'window.location.href=\'/forgot/password\'',
                        ]
                    ])
            )
            # Forgot. End!
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3([
                    'message' => 'There were problems with your captcha. Please try again or contact with support and provide following code(s): {{ errorCodes }}',
                    'messageMissingValue' => 'captcha.missing.value',
                ]),
                'action_name' => 'registration',
                # 'script_nonce_csp' => $nonceCSP,
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                'trim' => true,
                'csrf_protection'    => true,
                'csrf_field_name' => '_csrf_token',
                'csrf_token_id' => $this->token,
                'translation_domain' => 'vendor',
                'method' => 'POST',
                'row_attr' => [
                    'class' => 'mb-0'
                ],
                'attr' => [
                    'id' => 'login',
                    'name' => 'login',
                    'class' => 'needs-validation',
                    'novalidate' => null,
                ]
            ]
        );
    }

//    public function getBlockPrefix() {
//    }
    public function renderForm(Request $request, array $templateVars): Response
    {
        // TODO: Implement renderForm() method.
        return 'TODO: Implement renderForm() method';
    }
}