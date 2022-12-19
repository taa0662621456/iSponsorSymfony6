<?php


namespace App\ProductBundle\Form\Type;



final class ProductOptionTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.option.name',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_translation';
    }
}
