<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\Categories;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
				->add(
					'published', CheckboxType::class, array(
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
				->add(
					'categoryEnGb', CategoriesEnGbType::class, array(
						'label'              => 'category.engb.label',
						'translation_domain' => 'category',
					)
				)
				->add(
					'categoryAttachments', CollectionType::class, array(
						'entry_type'         => CategoriesAttachmentsType::class,
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
				->add(
					'previous', ButtonType::class, array(
						'label' => 'label.previous',
						'attr'  => array(
							'id'    => 'next',
							'class' => 'btn btn-primary previous'
						)
					)
				)
				->add(
					'next', ButtonType::class, array(
						'label' => 'label.next',
						'attr'  => array(
							'id'    => 'next',
							'class' => 'btn btn-primary next'
						)
					)
				)
				->add(
					'submit', SubmitType::class, array(
						'label' => 'label.submit',
						'attr'  => array(
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
