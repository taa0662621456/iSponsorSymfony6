<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Entity\Category\Categories;
use App\Entity\Project\Projects;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('category', EntityType::class, array(
                'required'  => true,
                'multiple' => false,
                'class' => Categories::class,
                'choice_label' => 'id'
            ))
            /*
            ->add('fileName', FileType::class, array(
                'data_class' => null,
                'label' => 'Cover picture'
            ))
            */

            //->add('ordering')
            //->add('vendorId')
            //->add('categoryKey')
            /*
            ->add('tags', CollectionType::class, array(
                'entry_type' => TagType::class,
                'allow_add' => true
               ))
            */
            ->add('projectEnGb', ProjectsEnGbType::class)
            //->add('projectsAttachments', ProjectsAttachmentsType::class)
            ->add('projectsAttachments', CollectionType::class, array(
                'entry_type' => ProjectsTagsType::class,
                'allow_add' => true
            ))
            ->add('tags', ProjectsTagsType::class, array(
                'required'  => false,
            ))
        ;


    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
