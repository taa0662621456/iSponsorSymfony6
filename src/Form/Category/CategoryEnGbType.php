<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\CategoryUkUa;
	use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class CategoryEnGbType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add(
					'categoryName', TextType::class, [
                        'translation_domain' => 'category',
						'label'      => 'category.name.label',
						'label_attr' => [
							'class' => 'sr-only',
                        ],
						'required'   => true,
						'attr'       => [
							'id'          => 'categoryName',
							'class'       => 'form-control m-1',
							'placeholder' => 'category.name.placeholder',
							'tabindex'    => '101',
							'autofocus'   => true
                        ]
                    ]
				)
                ->add(
                    'slug', TextType::class, [
                        'translation_domain' => 'category',
                        'label'      => 'category.slug.label',
                        'label_attr' => [
                            'class' => 'sr-only',
                        ],
                        'required'   => true,
                        'attr'       => [
                            'id'          => 'categorySlug',
                            'class'       => 'form-control m-1',
                            'placeholder' => 'category.slug.placeholder',
                            'tabindex'    => '103',
                            'autofocus'   => true
                        ]
                    ]
                )
				->add(
					'categoryDesc', TextareaType::class, [
                        'translation_domain' => 'category',
						'label'      => 'category.desc.label',
						'label_attr' => [
							'class' => 'sr-only',
                        ],
						'attr'       => [
							'id'          => 'categoryDesc',
							'class'       => 'form-control m-1 reader',
							'placeholder' => 'category.desc.placeholder',
							'tabindex'    => '102',
							'autofocus'   => false
                        ]
                    ]
                )
				//->add('metaDesc')
				//->add('metaKey')
				//->add('customTitle')
			;
		}

		/**
		 * @param OptionsResolver $resolver
		 */
		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class' => CategoryUkUa::class,
				]
			);
		}
	}
