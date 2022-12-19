<?php


namespace App\AttributeBundle\Form\Type;



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
