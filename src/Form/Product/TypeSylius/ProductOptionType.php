<?php


namespace App\ProductBundle\Form\Type;



final class ProductOptionType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'form.option.position',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductOptionTranslationType::class,
                'label' => 'form.option.name',
            ])
            ->add('values', CollectionType::class, [
                'entry_type' => ProductOptionValueType::class,
                'allow_add' => true,
                'by_reference' => false,
                'label' => false,
                'button_add_label' => 'form.option_value.add_value',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_option';
    }
}
