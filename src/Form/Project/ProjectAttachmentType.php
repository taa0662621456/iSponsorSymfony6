<?php

namespace App\Form\Project;

use Symfony\Component\Form\AbstractType;
use App\Entity\Product\ProductAttachment;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProjectAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'firstTitle',
                FileType::class,
                [
                'data_class' => null,
                'empty_data' => '',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
//				'label'      => 'project.firsttitle.label',
                'label' => '',
                'attr' => [
                    'class' => 'file dropzone',
                    'multiple' => true,
                    'data-preview-file-type' => 'any',
                ],
                'constraints' => [
                    new File([
                        'mimeTypesMessage' => 'application/pdf',
                        'mimeTypes' => ['application/pdf', 'application/x-pdf'],
                        'maxSize' => '1M',
                        'notFoundMessage' => '',
                        'uploadErrorMessage' => '',
                    ]),
                    new Image([
                        'mimeTypes' => ['image/jpg', 'image/jpeg'],
                        'uploadErrorMessage' => '',
                        'mimeTypesMessage' => '',
                        'maxSizeMessage' => '',
                        'maxHeightMessage' => '',
                        'maxSize' => '1M',
                        'minHeight' => '200',
                        'minHeightMessage' => '',
                        'minWidth' => '200',
                        'minWidthMessage' => '',
                    ]),
                ],
                ]
            )
            ->add('fileTitle')
            ->add('fileDescription');
        /*
        ->add('fileMeta')
        ->add('fileClass')
        ->add('fileMimeType')
        ->add('fileType')
        ->add('fileUrl')
        ->add('fileUrlThumb')
        ->add('fileIsProductImage')
        ->add('fileIsDownloadable')
        ->add('fileIsForSale')
        ->add('fileParams')
        ->add('fileLang')
        ->add('isShared')
        ->add('published')
        /*
        ->add('createdAt')
        ->add('createdBy')
        ->add('modifiedOn')
        ->add('modifiedBy')
        ->add('lockedOn')
        ->add('lockedBy')
        ->add('project')
        */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => ProductAttachment::class,
                'translation_domain' => 'project',
            ]
        );
    }
}
