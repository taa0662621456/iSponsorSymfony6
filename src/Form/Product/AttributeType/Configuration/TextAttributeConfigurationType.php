<?php

namespace App\Form\Product\AttributeType\Configuration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

final class TextAttributeConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('min', NumberType::class, [
                'label' => 'form.attribute_type_configuration.text.min',
                'required' => false,
            ])
            ->add('max', NumberType::class, [
                'label' => 'form.attribute_type_configuration.text.max',
                'required' => false,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_configuration_text';
    }
}
