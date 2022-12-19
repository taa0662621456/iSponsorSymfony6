<?php


namespace App\ProductBundle\Form\Type;



final class ProductVariantType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'form.product.enabled',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductVariantTranslationType::class,
                'label' => 'form.product_variant.translations',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;

        $builder->addEventSubscriber(new BuildProductVariantFormSubscriber($builder->getFormFactory()));
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant';
    }
}
