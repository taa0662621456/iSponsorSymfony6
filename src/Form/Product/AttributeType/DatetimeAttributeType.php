<?php

namespace App\Form\Product\AttributeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

final class DatetimeAttributeType extends AbstractType
{
    public function getParent(): string
    {
        return DateTimeType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'label' => false,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->setRequired('configuration')
            ->setDefined('locale_code');
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_datetime';
    }
}
