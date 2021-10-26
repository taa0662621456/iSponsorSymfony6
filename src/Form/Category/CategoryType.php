<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\Category;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

    class CategoryType
		extends AbstractType
	{
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options): void
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
				->add(
					'categoryEnGb', CategoryEnGbType::class, array(
						'label'              => 'category.engb.label',
						'translation_domain' => 'category',
					)
				)
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
				->add(
					'categoryAttachments', CollectionType::class, array(
						'entry_type'         => CategoryAttachmentType::class,
						'label'              => 'category.attachment.label',
						'translation_domain' => 'category',
						'entry_options'      => array('label' => false),
						'required'           => false,
						//'empty_data' => true,
						'allow_add'          => true,
						'allow_delete'       => true,
						'prototype'          => true,
						//'prototype_name' => 'attach',
						//'prototype_data' => 'placeholder',
						//'by_reference' => false
						//'attr'         => [
						//	'class' => "{$name}-collection",
						//],
					)
				)
                )
                ->add(
                    $builder
                        ->create('step-3', FormType::class, array(
                            'inherit_data' => true,
                            'label' => false,
                            'row_attr'=> array(
                                'id' => 'step-3'
                            )
                        ))
                ->add('id', HiddenType::class)
                ->add('published', CheckboxType::class, array(
                        'label'              => 'category.published.label',
                        'translation_domain' => 'category',
                        'required'           => false
                    )
                )
                /*				->add('parent', CheckboxType::class, array(
                                        'label' => 'categories.parent',
                                        'class'        => Categories::class,
                                        'required'     => false,
                                        'multiple'     => false,
                                        'choice_label' => 'id'
                                    )
                                )*/
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
                    ->add(
                        'previous', ButtonType::class, array(
                            'label' => 'button.label.previous',
                            'translation_domain' => 'buttons',
                            'attr'  => array(
                                'id'    => 'next',
                                'class' => 'btn btn-primary previous'
                            )
                        )
                    )
                    ->add(
                        'next', ButtonType::class, array(
                            'label' => 'button.label.next',
                            'translation_domain' => 'buttons',
                            'attr'  => array(
                                'id'    => 'next',
                                'class' => 'btn btn-primary next'
                            )
                        )
                    )
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

		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class' => Category::class,
				]
			);
		}
	}
