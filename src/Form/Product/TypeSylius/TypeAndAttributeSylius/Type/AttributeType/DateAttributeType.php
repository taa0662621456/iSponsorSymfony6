<?php


namespace App\AttributeBundle\Form\Type\AttributeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class DateAttributeType extends AbstractType
{
    public function getParent(): string
    {
        return DateType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'label' => false,
                'widget' => 'single_text',
            ])
            ->setRequired('configuration')
            ->setDefined('locale_code')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_date';
    }
}
