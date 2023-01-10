<?php


namespace App\Form\Product\AttributeType\Type;



abstract class AttributeTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.attribute.name',
            ])
        ;
    }
}
