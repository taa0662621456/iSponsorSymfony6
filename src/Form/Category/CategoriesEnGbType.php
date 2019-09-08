<?php
declare(strict_types=1);

namespace App\Form\Category;

use App\Entity\Category\CategoriesEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesEnGbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoryName')
            //->add('categoryDesc')
            //->add('metaDesc')
            //->add('metaKey')
            //->add('customTitle')
            ->add('slug')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoriesEnGb::class,
        ]);
    }
}
