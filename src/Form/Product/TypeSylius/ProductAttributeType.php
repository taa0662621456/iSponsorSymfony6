<?php


namespace App\ProductBundle\Form\Type;



final class ProductAttributeType extends AttributeType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'form.product_attribute.position',
                'invalid_message' => 'product_attribute.invalid',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_attribute';
    }
}
