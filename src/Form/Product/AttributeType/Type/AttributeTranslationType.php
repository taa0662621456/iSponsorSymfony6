<?php


namespace App\Form\Product\AttributeType\Type;



use Symfony\Component\Form\FormBuilderInterface;

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
