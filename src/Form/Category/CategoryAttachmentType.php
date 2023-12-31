<?php

namespace App\Form\Category;

use Symfony\Component\Form\AbstractType;
use App\Entity\Category\CategoryAttachment;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CategoryAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'fileName',
                FileType::class,
                [
                    'required' => true,
                    'data_class' => null,
                    'translation_domain' => 'category',
                    'label' => 'category.attach.label',
                    'attr' => [
                        'class' => 'form-control m-1 file',
                        'multiple' => true,
                        'data-preview-file-type' => 'any',
                    ],
                ]
            )
            ->add(
                'fileTitle',
                TextType::class,
                [
                    'required' => false,
                    'translation_domain' => 'category',
                    'label' => 'category.attach.title',
                    'attr' => [
                        'class' => 'form-control m-1',
                        'placeholder' => 'category.attach.title.placeholder',
                    ],
                ]
            )
            ->add(
                'fileDescription',
                TextareaType::class,
                [
                    'required' => false,
                    'translation_domain' => 'category',
                    'label' => 'category.attach.desc',
                    'attr' => [
                        'class' => 'form-control m-1',
                        'placeholder' => 'category.attach.desc.placeholder',
                    ],
                ]
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
            ->add('published');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => CategoryAttachment::class,
            ]
        );
    }
}
