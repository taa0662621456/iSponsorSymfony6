<?php


namespace App\ProductBundle\Form\Type;



final class ProductVariantTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.product_variant.name',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant_translation';
    }
}
