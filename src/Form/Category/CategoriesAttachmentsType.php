<?php
	declare(strict_types=1);

	namespace App\Form\Category;

	use App\Entity\Category\CategoriesAttachments;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\FileType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class CategoriesAttachmentsType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add(
					'fileName', FileType::class, array(
						'required'   => true,
						'data_class' => null,
						'label'      => 'category.attach.label',
						'attr'       => array(
							'class'                  => 'file',
							'multiple'               => true,
							'data-preview-file-type' => 'any'
						)
					)
				)
				->add(
					'fileTitle', TextType::class, array(
						'required' => false,
						'label'    => 'category.attach.title',
						'attr'     => array(
							'class'       => 'form-control',
							'placeholder' => 'category.attach.title.placeholder',
						)
					)
				)
				->add(
					'fileDescription', TextareaType::class, array(
						'required' => false,
						'label'    => 'category.attach.desc',
						'attr'     => array(
							'class'       => 'form-control',
							'placeholder' => 'category.attach.desc.placeholder',
						)
					)
				)
				->add('fileMeta')
				->add('fileClass')
				->add('fileLang')
				/*
				->add('fileMimeType')
				->add('fileType')
				->add('fileUrl')
				->add('fileUrlThumb')
				->add('fileIsProductImage')
				->add('fileIsDownloadable')
				->add('fileIsForSale')
				->add('fileParams')
				->add('isShared')
				->add('category')
				*/
				->add('published')
			;
		}

		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class' => CategoriesAttachments::class,
				]
			);
		}
	}
