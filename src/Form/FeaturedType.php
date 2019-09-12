<?php

namespace App\Form;

use App\Entity\Featured;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeaturedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ordering')
            ->add('featuredType')
            ->add('projectFeatured')
            ->add('productFeatured')
            ->add('categoryFeatured')
            ->add('vendorFeatured')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Featured::class,
        ]);
    }
}
