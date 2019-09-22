<?php
declare(strict_types=1);

namespace App\Form\Category;

use App\Entity\Category\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            //->add('id')
            ->add('published')
            /*
            ->add('createdOn')
            ->add('createdBy')
            ->add('modifiedOn')
            ->add('modifiedBy')
            ->add('lockedOn')
            ->add('lockedBy')

            ->add('fileName', FileType::class, array(
                'data_class' => null,
                'label' => 'Category Picture'
            ))
            //->add('file', FileType::class)
            */
            ->add('categoryEnGb', CategoriesEnGbType::class)
            //->add('categoriesAttachments', CategoriesAttachmentsType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
