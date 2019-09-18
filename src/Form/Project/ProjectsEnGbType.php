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
            	'label' => 'label.project.title',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'required' => true,
				'attr' => array(
					'id' => 'projectTitle',
					'class' => 'form-control',
					'placeholder' => 'Enter project title',
					'tabindex' => '101',
					'autofocus' => true
				),
			))
            ->add('projectSDesc', TextareaType::class, array(
            	'label' => 'label.project.sdesc',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr' => array(
					'id' => 'projectSDesc',
					'class' => 'form-control',
					'placeholder' => 'Enter project short description',
					'tabindex' => '102',
					'autofocus' => false
				)
			))
            ->add('projectDesc', TextareaType::class, array(
            	'label' => 'label.project.desc',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr' => array(
					'id' => 'projectDesc',
					'class' => 'form-control',
					'placeholder' => 'Enter project description',
					'tabindex' => '103',
					'autofocus' => false
				)
			))
            ->add('slug', TextType::class, array(
            	'label' => 'slug',
				'label_attr' => array(
					'class' => 'sr-only',
				),
				'attr' => array(
					'id' => 'slug',
					'class' => 'form-control',
					'placeholder' => 'Enter tags for project',
					'tabindex' => '103',
					'autofocus' => false
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

