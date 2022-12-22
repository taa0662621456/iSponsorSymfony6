<?php


namespace App\ProductBundle\Form\Type;



final class ProductOptionValueTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value', TextType::class, [
                'label' => 'form.option_value.value',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_value_translation';
    }
}