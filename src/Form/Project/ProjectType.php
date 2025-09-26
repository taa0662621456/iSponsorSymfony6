<?php


namespace App\Form\Project;

use App\Entity\Category\Category;
use App\Entity\Project\Project;
use App\Form\Type\AttachmentFormLinksType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
            ->add('id', HiddenType::class, [
                'empty_data' => '',
            ])
            ->add(
                $builder
                    ->create('stepOne', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-1'
                        ],
                    ])
                    ->add('projectCategory', EntityType::class, [
                        'class' => Category::class,
                        'required' => true,
                        'multiple' => false,
                        'label' => false,
                        'empty_data' => '',
                        'choice_label' => 'id',
                        'row_attr' => [
                            'class' => ''
                        ],
                    ])
            )
            ->add(
                $builder
                    ->create('stepTwo', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-2'
                        ],
                    ])
                    ->add('projectEnGb', ProjectEnGbType::class, [
                            'label' => false,
                            'row_attr' => [
                                'id' => 'project',
                                ]
                        ])
            )
            ->add(
                $builder
                    ->create('stepThree', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-3'
                        ],
                    ])
                    ->add('projectAttachment', CollectionType::class, [
                            'entry_type' => ProjectAttachmentType::class,
//                            'label' => 'project.attachment.label',
//                            'data_class' => null,
                            'label' => false,
                            'by_reference' => false,
                            'translation_domain' => 'project',
                            'entry_options' => [
                                'label' => false,
                                'required' => false,
                                'mapped' => false,
                                'empty_data' => '',
                                'by_reference' => false,
                                ],
                            'required' => false,
                            'mapped' => false,
                            'empty_data' => '',
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true,
                        ])
                    ->add(
                        $builder
                            ->create('attachmentFormLinks', FormType::class, [
                                'label' => false,
                                'mapped' => false,
                                'required' => false,
                                'attr' => [
                                    'class' => 'btn-group m-1'
                                    ]
                                ])
                            ->add('add_item_link', ButtonType::class, [
                                'label' => 'Add file',
                                'attr' => [
                                    'data-collection-holder-class' => 'projectAttachments',
                                    'class' => 'btn btn-primary add_item_link',

                                ]
                            ])
                            ->add('rem_item_link', ButtonType::class, [
                                'label' => 'Remove record',
                                'attr' => [
                                    'data-collection-holder-class' => 'projectAttachments',
                                    'class' => 'btn btn-primary rem_item_link',

                                ]
                            ])
                        )
            )
            ->add(
                $builder
                    ->create('stepFour', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-4'
                        ],
                    ])
                    ->add('projectTag', ProjectTagType::class, [
                            'required' => false,
                            'label' => false,
                            'empty_data' => '',
                    ])
            )
            ->add(
                $builder
                    ->create('step', FormType::class, [
                        'inherit_data' => true,
                        'translation_domain' => 'label',
                        'label' => false,
                        'attr' => [
                            'class' => 'btn-group m-1'
                        ]
                    ])
                    ->add('previous', ButtonType::class, [
                            'label' => 'label.previous',
                            'attr' => [
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-prev'
                            ]
                        ])
                    ->add('next', ButtonType::class, [
                            'label' => 'label.next',
                            'attr' => [
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-next'
                            ]
                        ])
            )
			->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.submit.new.project.label',
				'attr' => [
					'class' => 'btn btn-primary submit',
                ]
            ])
        ;

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

	}

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'translation_domain' => 'project',
            'method' => 'POST',
            'label' => false,
            'attr' => array(
                'id' => 'object',
                'class'       => 'm-1'
            )
        ]);
    }
}
