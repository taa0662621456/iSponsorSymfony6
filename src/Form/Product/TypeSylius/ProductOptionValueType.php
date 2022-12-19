<?php


namespace App\ProductBundle\Form\Type;



final class ProductOptionValueType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductOptionValueTranslationType::class,
                'label' => 'form.option.name',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_value';
    }
}
