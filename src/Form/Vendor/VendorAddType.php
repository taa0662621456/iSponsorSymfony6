<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendor;
	use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorAddType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
                ->add(
                    $builder
                        ->create('step-1', FormType::class, [
                            'inherit_data' => true,
                            'label' => false,
                            'row_attr' => [
                                'id' => 'step-1'
                            ],
                        ])
				->add('vendorSecurity', VendorSecurityType::class)
                )
                ->add(
                    $builder
                        ->create('step-2', FormType::class, [
                            'inherit_data' => true,
                            'label' => false,
                            'row_attr' => [
                                'id' => 'step-2'
                            ],
                        ])
				->add('vendorEnGb', VendorEnGbType::class)
				->add('slug', TextType::class, [
						'label'      => 'label.slug',
						'label_attr' => [
							'class' => 'sr-only'
                        ],
						'required'   => false
                ])
                )
                ->add( //TODO: повторяющийся код. Вынести в отдельную форму и добавлять, как дочернюю
                    $builder
                        ->create('steps', FormType::class, [
                            'translation_domain' => 'button',
                            'inherit_data' => true,
                            'label' => false,
                            'attr'=> [
                                'class' => 'btn-group m-1'
                            ]
                        ])
                    ->add('previous', SubmitType::class, [
                        'label' => 'button.label.previous',
                        'translation_domain' => 'button',
                        'attr' => [
                            'id' => 'next',
                            'class' => 'btn btn-primary previous'
                        ]
                    ])
                    ->add('next', SubmitType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.next',
                        'attr' => [
                            'id' => 'next',
                            'class' => 'btn btn-primary next'
                        ]
                    ])
                )
                ->add(
                    $builder //TODO: повторяющийся код. Вынести в отдельную форму и добавлять, как дочернюю
                        ->create('submit', FormType::class, [
                            'inherit_data' => true,
                            'label' => false,
                            'attr'=> [
                                'class' => 'btn-group m-1'
                            ]
                    ])
                        ->add(
                            'back', ButtonType::class, [
                                'label' => 'button.label.back',
                                'translation_domain' => 'button',
                                'attr'  => [
                                    'class' => 'btn btn-primary back',
                                    'onclick' => 'window.history.back()'
                                ]
                            ]
                        )
                        ->add(
                            'submitAndNew', SubmitType::class, [
                                'translation_domain' => 'button',
                                'label' => 'button.label.submitAndNew',
                                'attr'  => [
                                    'class' => 'btn btn-primary submitAndNew'
                                ]
                            ]
                        ) //TODO: добавить в контролер по этой доке https://symfony.com/doc/current/form/multiple_buttons.html
                        ->add(
                            'submit', SubmitType::class, [
                                'translation_domain' => 'button',
                                'label' => 'button.label.submit',
                                'attr'  => [
                                    'class' => 'btn btn-primary submit'
                                ]
                            ]
                        )
                )
			;

		}

		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
				'data_class' => Vendor::class,
                'translation_domain' => 'vendor'
			]);
		}
	}
