<?php


namespace App\ProductBundle\Form\Type;



final class ProductAssociationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ProductAssociationTypeChoiceType::class, [
                'label' => 'form.product_association.type',
            ])
            ->add('product', ProductChoiceType::class, [
                'label' => 'form.product_association.product',
                'property_path' => 'associatedProducts',
                'multiple' => true,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_association';
    }
}
