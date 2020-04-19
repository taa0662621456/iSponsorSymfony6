<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsAddType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
                ->add(
                    $builder
                        ->create('step-1', FormType::class, array(
                            'inherit_data' => true,
                            'label' => false,
                            'row_attr' => array(
                                'id' => 'step-1'
                            ),
                        ))
				->add('vendorSecurity', VendorsSecurityType::class)
                )
                ->add(
                    $builder
                        ->create('step-2', FormType::class, array(
                            'inherit_data' => true,
                            'label' => false,
                            'row_attr' => array(
                                'id' => 'step-2'
                            ),
                        ))
				->add('vendorEnGb', VendorsEnGbType::class)
				->add('slug', TextType::class, array(
						'label'      => 'label.slug',
						'label_attr' => array(
							'class' => 'sr-only'
						),
						'required'   => false
					))
                )
                ->add(
                    $builder
                        ->create('steps', FormType::class, array(
                            'inherit_data' => true,
                            'label' => false,
                            'attr'=> array(
                                'class' => 'btn-group'
                            )
                        ))
                    ->add('previous', SubmitType::class, array(
                        'label' => 'button.label.previous',
                        'translation_domain' => 'buttons',
                        'attr' => array(
                            'id' => 'next',
                            'class' => 'btn btn-primary previous'
                        )
                    ))
                    ->add('next', SubmitType::class, array(
                        'label' => 'button.label.next',
                        'translation_domain' => 'buttons',
                        'attr' => array(
                            'id' => 'next',
                            'class' => 'btn btn-primary next'
                        )
                    ))
                )
                ->add(
                    $builder
                        ->create('submit', FormType::class, array(
                            'inherit_data' => true,
                            'label' => false,
                            'attr'=> array(
                                'class' => 'btn-group'
                            )
                        ))
                        ->add(
                            'back', ButtonType::class, array(
                                'label' => 'button.label.back',
                                'translation_domain' => 'buttons',
                                'attr'  => array(
                                    'class' => 'btn btn-primary back',
                                    'onclick' => 'window.history.back()'
                                )
                            )
                        )
                        ->add(
                            'submitAndNew', SubmitType::class, array(
                                'label' => 'button.label.submitAndNew',
                                'translation_domain' => 'buttons',
                                'attr'  => array(
                                    'class' => 'btn btn-primary submitAndNew'
                                )
                            )
                        ) //TODO: добавить в контролер по этой доке https://symfony.com/doc/current/form/multiple_buttons.html
                        ->add(
                            'submit', SubmitType::class, array(
                                'label' => 'button.label.submit',
                                'translation_domain' => 'buttons',
                                'attr'  => array(
                                    'class' => 'btn btn-primary submit'
                                )
                            )
                        )
                )
			;

		}

		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
				'data_class' => Vendors::class,
                'translation_domain' => 'vendor'
			]);
		}
	}
