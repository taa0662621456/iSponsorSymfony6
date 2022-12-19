<?php


namespace App\AttributeBundle\Form\Type\AttributeType\Configuration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectAttributeConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('choices', SelectAttributeChoicesCollectionType::class, [
                'entry_type' => SelectAttributeValueTranslationsType::class,
                'label' => 'form.attribute_type_configuration.select.values',
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'entry_options' => [
                    'entry_type' => TextType::class,
                ],
            ])
            ->add('multiple', CheckboxType::class, [
                'label' => 'form.attribute_type_configuration.select.multiple',
            ])
            ->add('min', NumberType::class, [
                'label' => 'form.attribute_type_configuration.select.min',
                'required' => false,
            ])
            ->add('max', NumberType::class, [
                'label' => 'form.attribute_type_configuration.select.max',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_configuration_select';
    }
}
