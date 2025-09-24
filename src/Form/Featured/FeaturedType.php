<?php

namespace App\Form\Featured;

use App\Entity\Featured\Featured;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeaturedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ordering')
            ->add('featuredType')
            ->add('projectFeatured')
            ->add('productFeatured')
            ->add('categoryFeatured')
            ->add('vendorFeatured');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Featured::class,
        ]);
    }
}