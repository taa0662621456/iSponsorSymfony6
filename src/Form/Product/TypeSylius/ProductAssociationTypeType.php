<?php


namespace App\ProductBundle\Form\Type;



final class ProductAssociationTypeType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductAssociationTypeTranslationType::class,
                'label' => 'form.product_association_type.translations',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_association_type';
    }
}