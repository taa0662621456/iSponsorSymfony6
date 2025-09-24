<?php

namespace App\Form\Product\AttributeType\Configuration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class DatetimeAttributeConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('format', TextType::class, [
                'label' => 'form.attribute_type_configuration.datetime.format',
                'required' => false,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_configuration_datetime';
    }
}