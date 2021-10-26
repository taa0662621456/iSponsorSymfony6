<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Category\Category;
use App\Entity\Project\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
            ->add(
                $builder
                    ->create('step-1', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-1'
                        ),
                    ))
                    ->add('id', HiddenType::class)
                    ->add('projectCategory', EntityType::class, array(
                        'class' => Category::class,
                        'required' => true,
                        'multiple' => false,
                        'choice_label' => 'id'
                    ))
            )
            ->add('projectEnGb', ProjectEnGbType::class, array(
                    'label' => false,
                    'row_attr' => array(
                        'id' => 'project')
                )
            )
            ->add(
                $builder
                    ->create('step-4', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-5'
                        ),
                    ))
                    ->add('projectAttachments', CollectionType::class, array(
                            'entry_type' => ProjectAttachmentType::class,
                            'label' => 'project.attachment.label',
                            'translation_domain' => 'project',
                            'entry_options' => array('label' => false),
                            'required' => false,
                            //'empty_data' => true,
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true,
                        )
                    )
            )
            ->add(
                $builder
                    ->create('step-6', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-6'
                        ),
                    ))
                    ->add('projectTags', ProjectTagType::class, array(
                            'required' => false,
                        )
                    )
            )
            ->add(
                $builder
                    ->create('step', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'attr' => array(
                            'class' => 'btn-group'
                        )
                    ))
                    ->add('previous', ButtonType::class, array(
                            'label' => 'label.previous',
                            'attr' => array(
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-prev'
                            )
                        )
                    )
                    ->add('next', ButtonType::class, array(
                            'label' => 'label.next',
                            'attr' => array(
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-next'
                            )
                        )
                    )
            )
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
            'data_class' => Project::class,
            'translation_domain' => 'project',
            'method' => 'POST',
            'attr' => array(
                'id' => 'object'
            )
        ]);
    }
}
