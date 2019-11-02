<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Category\Categories;
use App\Entity\Project\Projects;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
			->add('id', HiddenType::class)
			/*->add('projectCategory', EntityType::class, array(
					'class'        => Categories::class,
					'required'     => true,
					'multiple'     => false,
					'choice_label' => 'id'
				)
			)*/
			->add('projectEnGb', ProjectsEnGbType::class)
			->add(
				'projectAttachments', CollectionType::class, array(
					'entry_type'         => ProjectsAttachmentsType::class,
					'label'              => 'project.attachment.label',
					'translation_domain' => 'project',
					'entry_options'      => array('label' => false),
					'required'           => false,
					//'empty_data' => true,
					'allow_add'          => true,
					'allow_delete'       => true,
					'prototype'          => true,
				)
			)
			->add(
				'projectTags', ProjectsTagsType::class, array(
					'required' => false,
				)
			)
			->add('previous', SubmitType::class, array(
				'label' => 'label.previous',
				'attr' => array(
					'id' => 'next',
					'class' => 'btn btn-primary previous'
				)
			))
			->add('next', SubmitType::class, array(
				'label' => 'label.next',
				'attr' => array(
					'id' => 'next',
					'class' => 'btn btn-primary next'
				)
			))
			->add('submit', SubmitType::class, array(
				'attr' => array(
					'class' => 'btn btn-primary submit'
				)
			))
		//$languages = $request->getLanguages();
		//$this->getUser()->getCulture();
		//->add('langType', ChoiceType::class, array(
		//					//'choices' => array_flip($cultures),
		//					'choices' => Intl::getRegionBundle()->getCountryNames(),
		//					'label'=>'label.languages',
		//					'label_attr' => array(
		//						'class' => ''
		//					),
		//					'value' =>	$this->getUser()->getCulture();
		//					'required' => false,
		//					'attr' => array(
		//						'id' => 'languages',
		//						'class' => 'form-control',
		//						'placeholder' => 'Enter Your country name',
		//						'autofocus' => true
		//					), )
		;
	}

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
			'attr' => array(
				'id' => 'msform'
			)
        ]);
    }
}
