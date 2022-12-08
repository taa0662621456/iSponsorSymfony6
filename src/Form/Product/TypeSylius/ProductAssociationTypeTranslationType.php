<?php


namespace App\ProductBundle\Form\Type;



final class ProductAssociationTypeTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.product_association_type.name',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_association_type_translation';
    }
}
