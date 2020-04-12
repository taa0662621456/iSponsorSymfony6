<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\CategoriesEnGb;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class CategoriesEnGbType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add(
					'categoryName', TextType::class, array(
						'label'      => 'category.name.label',
						'label_attr' => array(
							'class' => 'sr-only',
						),
						'required'   => true,
						'attr'       => array(
							'id'          => 'categoryName',
							'class'       => 'form-control',
							'placeholder' => 'category.name.placeholder',
							'tabindex'    => '101',
							'autofocus'   => true
						)
					)
				)
				->add(
					'categoryDesc', TextareaType::class, array(
						'label'      => 'category.desc.label',
						'label_attr' => array(
							'class' => 'sr-only',
						),
						'attr'       => array(
							'id'          => 'categoryDesc',
							'class'       => 'form-control reader',
							'placeholder' => 'category.desc.placeholder',
							'tabindex'    => '102',
							'autofocus'   => false
						)
					)
				)
				//->add('metaDesc')
				//->add('metaKey')
				//->add('customTitle')
				->add(
					'slug', TextType::class, array(
						'label'      => 'category.slug.label',
						'label_attr' => array(
							'class' => 'sr-only',
						),
						'required'   => true,
						'attr'       => array(
							'id'          => 'categorySlug',
							'class'       => 'form-control ',
							'placeholder' => 'category.slug.placeholder',
							'tabindex'    => '103',
							'autofocus'   => true
						)
					)
				)
			;
		}

		/**
		 * @param OptionsResolver $resolver
		 */
		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class' => CategoriesEnGb::class,
				]
			);
		}
	}
