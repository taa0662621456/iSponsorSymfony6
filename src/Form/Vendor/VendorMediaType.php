<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorMediaAttachment;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorMediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//			->add('uuid')
//			->add('slug')
//            ->add('upload_dir')
//			->add('createdAt')
//			->add('createdBy')
//			->add('modifiedOn')
//			->add('modifiedBy')
//			->add('lockedOn')
//			->add('lockedBy')
//			->add('version')
            ->add('firstTitle')
            ->add('lastTitle')
//			->add('fileMeta')
//			->add('fileClass')
//			->add('fileMimeType')
//			->add('fileLayoutPosition')
//			->add('filePath')
//			->add('filePathThumb')
            ->add('fileIsDownloadable')
            ->add('fileIsForSale')
//			->add('fileParams')
//			->add('fileLang')
//			->add('fileShared')
            ->add('published')
//			->add('attachments')
            ->add('fileVich', VichFileType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => VendorMediaAttachment::class,
                'translation_domain' => 'vendor',
            ]
        );
    }
}
