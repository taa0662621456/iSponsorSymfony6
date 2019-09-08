<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Project\ProjectsEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextareaType, TextType};
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
            ->add('projectTitle', TextType::class, ['label' => 'projectTitle'])
            ->add('projectSDesc', TextareaType::class, ['label' => 'projectSDesc'])
            ->add('projectDesc', TextareaType::class, ['label' => 'projectDesc'])

            /*
            ->add('categoriesEnGb', EntityType::class, array (
                'class' => CategoriesEnGb::class,
                'choice_label' => 'categoryName'
                ))
            */

            ->add('projectProductName', TextType::class, ['label' => 'productName'])
            ->add('projectProductSDesc', TextareaType::class, ['label' => 'productSDesc'])
            ->add('projectProductDesc', TextareaType::class, ['label' => 'productDesc'])
            ->add('slug', TextType::class, ['label' => 'slug'])
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

