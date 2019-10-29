<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Project\ProjectsEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectsEnGbType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('projectTitle', TextType::class, array(
				'label'      => 'project.title.label',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'required'   => true,
				'attr'       => array(
					'id'          => 'projectTitle',
					'class'       => 'form-control',
					'placeholder' => 'project.title.placeholder',
					'tabindex'    => '101',
					'autofocus'   => true
				)
			))
            ->add('projectSDesc', TextareaType::class, array(
				'label'      => 'project.sdesc.label',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr'       => array(
					'id'          => 'projectSDesc',
					'class'       => 'form-control',
					'placeholder' => 'project.sdesc.placeholder',
					'tabindex'    => '102',
					'autofocus'   => false
				)
			))
            ->add('projectDesc', TextareaType::class, array(
				'label'      => 'project.desc.label',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr'       => array(
					'id'          => 'projectDesc',
					'class'       => 'form-control',
					'placeholder' => 'project.desc.placeholder',
					'tabindex'    => '103',
					'autofocus'   => false
				)
			))
            ->add('slug', TextType::class, array(
				'label'      => 'project.slug.label',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr'       => array(
					'id'          => 'slug',
					'class'       => 'form-control',
					'placeholder' => 'project.slug.placeholder',
					'tabindex'    => '103',
					'autofocus'   => false
				)
			))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectsEnGb::class,
        ]);
    }
}

