<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Project\ProjectEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{FormType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectEnGbType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                $builder
                    ->create('step-2', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-2'
                        ],
                    ])
                    ->add('projectTitle', TextType::class, [
                        'label' => 'project.title.label',
                        'label_attr' => [
                            'class' => 'sr-only',
                        ],
                        'required' => true,
                        'attr' => [
                            'id' => 'projectTitle',
                            'class' => 'form-control m-1',
                            'placeholder' => 'project.title.placeholder',
                            'tabindex' => '101',
                            'autofocus' => true
                        ]
                    ])
                    ->add('projectSDesc', TextareaType::class, [
                        'label' => 'project.sdesc.label',
                        'label_attr' => [
                            'class' => 'sr-only',
                        ],
                        'attr' => [
                            'id' => 'projectSDesc',
                            'class' => 'form-control m-1',
                            'placeholder' => 'project.sdesc.placeholder',
                            'tabindex' => '102',
                            'autofocus' => false
                        ]
                    ])
            )
            ->add(
                $builder
                    ->create('step-3', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-3'
                        ],
                    ])
                    ->add('projectDesc', TextareaType::class, [
                        'label' => 'project.desc.label',
                        'label_attr' => [
                            'class' => 'sr-only',
                        ],
                        'attr' => [
                            'id' => 'projectDesc',
                            'class' => 'form-control reader m-1',
                            'placeholder' => 'project.desc.placeholder',
                            'tabindex' => '103',
                            'autofocus' => false
                        ]
                    ])
            )
            ->add(
                $builder
                    ->create('step-4', FormType::class, [
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => [
                            'id' => 'step-4'
                        ],
                    ])
                    ->add('slug', TextType::class, [
                        'label' => 'project.slug.label',
                        'label_attr' => [
                            'class' => 'sr-only',
                        ],
                        'attr' => [
                            'id' => 'slug',
                            'class' => 'form-control m-1',
                            'placeholder' => 'project.slug.placeholder',
                            'tabindex' => '103',
                            'autofocus'   => false
                        ]
                    ])
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => ProjectEnGb::class,
                'translation_domain' => 'project',
                'attr' => array(
                    'id' => 'project'
                ),
            ]);
    }
}

