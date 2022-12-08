<?php


namespace App\CoreBundle\Form\Type\Grid\Filter;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @experimental
 */
final class EntitiesFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'class' => null,
                'label' => false,
                'placeholder' => 'ui.all',
            ])
        ;
    }

    public function getParent(): string
    {
        return EntityType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'grid_filter_entities';
    }
}
