<?php


namespace App\Form\Product;

use App\Entity\Product\ProductAttachment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ProductAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('file', FileType::class, [
                'data_class' => null,
                'mapped' => false,
                'required' => false,
//                'label' => 'product.file.label',
                'label' => false,
                'attr' => [
                    'class' => 'file',
                    'multiple' => true,
                    'data-preview-file-type' => 'any'
                ],
                'constraints'     => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'product.message.mime',
                    ]),
                    new Length([
                        'min' => 30,
                        'minMessage' => 'Название не может быть  {{ limit }} characters',
                        'max' => 255,
                        'maxMessage' => 'Название не может быть больше  {{ limit }} characters',

                    ])
                ],
            ])
            ->add('filezone', DropzoneType::class, [
                'data_class' => null,
                'label' => 'product.file.label',
            ])
            /*
            ->add('fileTitle')
            ->add('fileDescription')
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
            ->add('product')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => ProductAttachment::class,
			'translation_domain' => 'product'
		]);
    }
}
