<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\VendorsSecurity;
	use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsLoginType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add(
					'email', EmailType::class, array(
					'invalid_message' => 'The email address is invalid.',
                    'translation_domain' => 'security',
					'label'           => 'security.email.label',
					'label_attr'      => array(
						'class' => '',
						'value' => 'last_username'
					),
					'required'        => true,
					'attr'            => array(
						'id'          => 'email',
						'name'        => '_email',
						'class'       => 'form-control',
						'placeholder' => 'security.email.placeholder',
						'tabindex'    => '101',
						//'autofocus' => true
					),
				)
				)
				->add(
					'password', PasswordType::class, array(
					'invalid_message' => 'The password is invalid.',
                    'translation_domain' => 'security',
					'required'        => true,
					'attr'            => array(
						'id'          => 'password',
						'name'        => '_password',
						'class'       => 'form-control',
						'placeholder' => 'security.password.placeholder',
						'tabindex'    => '203'
					)
				)
				)
				->add('submit', SubmitType::class, array(
                    'translation_domain' => 'button',
					'label' => 'button.submit.label',
					'attr'  => array(
						'class' => 'btn btn-primary btn-block'
					)
				))
				->add('remember', CheckboxType::class, array(
                    'translation_domain' => 'buttons',
					'mapped'     => false,
					'label'      => 'button.remember.label',
					'required'   => false,
					'label_attr' => array(
						'class' => ''
					),
					'attr'       => array(
						'id'    => 'remember_me',
						'name'  => '_remember_me',
						'class' => ''
					),
				))
                ->add(
                    'back', ButtonType::class, array(
                        'label' => 'btn.label.back',
                        'translation_domain' => 'buttons',
                        'attr'  => array(
                            'class' => 'btn btn-primary btn-block back',
                            'onclick' => 'window.history.back()'
                        )
                    )
                )
                ->add(
                    'signup', ButtonType::class, array(
                        'label' => 'btn.label.signup',
                        'translation_domain' => 'buttons',
                        'attr'  => array(
                            'class' => 'btn btn-link btn-sm signup',
                            'onclick' => 'window.history.back()'
                        )
                    )
                )
				->add('token', HiddenType::class, array(
					'mapped' => false,
					'attr' => array(
						'name' => '_csrf_token',
					),
				));
		}


		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				array(
					'csrf_protection'    => true,
					'csrf_field_name'    => '_csrf_token',
					'csrf_token_id'      => '6cb546b7fb9e056773030920402e4172',
					'translation_domain' => 'vendor', //TODO: дублируется объявление на форму и на поля. Нужно определиться и правильно организовать переводы (структуру файлов)
					'method'             => 'POST',
					'attr'               => array(
						'id'   => 'login',
						'name' => 'login'
					)
				)
			);
		}

		public function getBlockPrefix() { }
	}