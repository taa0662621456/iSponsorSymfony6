<?php


namespace App\Form\Project;

use App\Entity\Project\ProjectAttachment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
			->add(
				'fileName', FileType::class, array(
				'data_class' => null,
				'multiple'   => true,
				'label'      => 'project.filename.label',
				'attr'       => array(
					'class'                  => 'file',
					'multiple'               => true,
					'data-preview-file-type' => 'any'
				)
			)
			)
            ->add('fileTitle')
            ->add('fileDescription')
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults(
			[
				'data_class'         => ProjectAttachment::class,
				'translation_domain' => 'project'
			]);
    }
}
