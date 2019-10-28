<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\Categories;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class CategoriesType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add('id', HiddenType::class)
				->add('published')
				->add(
					'parent', EntityType::class, array(
						'class'        => Categories::class,
						'required'     => false,
						'multiple'     => false,
						'choice_label' => 'id'
					)
				)
				->add('categoryEnGb', CategoriesEnGbType::class)
				->add(
					'categoriesAttachments', CategoriesAttachmentsType::class, array(
						'entry_type' => CollectionType::class,
						'allow_add'  => true
					)
				)
				->add(
					'previous', SubmitType::class, array(
						'label' => 'label.previous',
						'attr'  => array(
							'id'    => 'next',
							'class' => 'btn btn-primary previous'
						)
					)
				)
				->add(
					'next', SubmitType::class, array(
						'label' => 'label.next',
						'attr'  => array(
							'id'    => 'next',
							'class' => 'btn btn-primary next'
						)
					)
				)
				->add(
					'submit', SubmitType::class, array(
						'attr' => array(
							'class' => 'btn btn-primary submit'
						)
					)
				)
			;
		}

		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class' => Categories::class,
				]
			);
		}
	}
