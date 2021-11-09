<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\VendorSecurity;
	use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorLoginType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
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
						'class'       => 'form-control',
						'placeholder' => 'vendor.placeholder.email',
						'tabindex'    => '101',
						//'autofocus' => true
                    ],
                    ]
				)
				->add('password', PasswordType::class, [
					'invalid_message' => 'The password is invalid.',
                    'label'           => 'vendor.label.password',
                    'label_attr'      => [
                        'class' => 'sr-only'
                    ],
					'required'        => true,
					'attr'            => [
						'id'          => 'password',
						'name'        => '_password',
						'class'       => 'form-control',
						'placeholder' => 'vendor.placeholder.password',
						'tabindex'    => '203'
                    ]
                ])
				->add('remember', CheckboxType::class, [
					'mapped'     => false,
                    'translation_domain' => 'button',
					'label'      => 'button.label.remember',
					'required'   => false,
					'label_attr' => [
						'class' => ''
                    ],
					'attr'       => [
						'id'    => 'remember_me',
						'name'  => '_remember_me',
						'class' => ''
                    ],
                ])
                ->add('submit', SubmitType::class, [
                    'translation_domain' => 'button',
                    'label' => 'button.label.authorization',
                    'attr'  => [
                        'class' => 'btn btn-primary btn-block'
                    ]
                ])
                ->add(
                $builder
                    ->create('group', FormType::class, [
                        'translation_domain' => 'button',
                        'inherit_data' => true,
                        'label' => false,
                        'attr'=> [
                            'class' => 'btn-group m-1'
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
                            'onclick' => 'window.history.back()' //TODO: заменить на маршрут к форме регистрации
                        ]
                    ])
                );
		}


		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults([
                    'csrf_protection' => true,
                    'csrf_field_name' => '_csrf_token',
                    'csrf_token_id' => 'authenticate',
                    'translation_domain' => 'vendor',
                    'method' => 'POST',
                    'attr' => [
                        'id' => 'login',
                        'name' => 'login'
                    ]
                ]
			);
		}

		public function getBlockPrefix() { }
	}
