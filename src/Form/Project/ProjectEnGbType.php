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
                    ->create('step-2', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-2'
                        ),
                    ))
                    ->add('projectTitle', TextType::class, array(
                        'label' => 'project.title.label',
                        'label_attr' => array(
                            'class' => 'sr-only',
                        ),
                        'required' => true,
                        'attr' => array(
                            'id' => 'projectTitle',
                            'class' => 'form-control',
                            'placeholder' => 'project.title.placeholder',
                            'tabindex' => '101',
                            'autofocus' => true
                        )
                    ))
                    ->add('projectSDesc', TextareaType::class, array(
                        'label' => 'project.sdesc.label',
                        'label_attr' => array(
                            'class' => 'sr-only',
                        ),
                        'attr' => array(
                            'id' => 'projectSDesc',
                            'class' => 'form-control',
                            'placeholder' => 'project.sdesc.placeholder',
                            'tabindex' => '102',
                            'autofocus' => false
                        )
                    ))
            )
            ->add(
                $builder
                    ->create('step-3', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-3'
                        ),
                    ))
                    ->add('projectDesc', TextareaType::class, array(
                        'label' => 'project.desc.label',
                        'label_attr' => array(
                            'class' => 'sr-only',
                        ),
                        'attr' => array(
                            'id' => 'projectDesc',
                            'class' => 'form-control reader',
                            'placeholder' => 'project.desc.placeholder',
                            'tabindex' => '103',
                            'autofocus' => false
                        )
                    ))
            )
            ->add(
                $builder
                    ->create('step-4', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-4'
                        ),
                    ))
                    ->add('slug', TextType::class, array(
                        'label' => 'project.slug.label',
                        'label_attr' => array(
                            'class' => 'sr-only',
                        ),
                        'attr' => array(
                            'id' => 'slug',
                            'class' => 'form-control',
                            'placeholder' => 'project.slug.placeholder',
                            'tabindex' => '103',
                            'autofocus'   => false
                        )
                    ))
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

