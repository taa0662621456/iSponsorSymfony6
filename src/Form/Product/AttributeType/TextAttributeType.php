<?php

namespace App\Form\Product\AttributeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TextAttributeType extends AbstractType
{
    public const TYPE = 'text';

    public function getParent(): string
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'label' => false,
            ])
            ->setRequired('configuration')
            ->setDefined('locale_code');
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_text';
    }
}