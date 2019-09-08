<?php
declare(strict_types=1);

namespace App\Form\Category;

use App\Entity\Category\CategoriesAttachments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesAttachmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('file', FileType::class, array(
                'data_class' => null,
                'label' => 'Category\'s files',
                'attr' => array(
                    'class' => 'file',
                    'multiple' => true,
                    'data-preview-file-type' => 'any'
                )
            ))
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
            ->add('createdOn')
            ->add('createdBy')
            ->add('modifiedOn')
            ->add('modifiedBy')
            ->add('lockedOn')
            ->add('lockedBy')
            ->add('category')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => CategoriesAttachments::class,
        ]);
    }
}
