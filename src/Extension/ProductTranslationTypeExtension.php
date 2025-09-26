<?php


namespace App\Extension;



final class ProductTranslationTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('shortDescription', TextareaType::class, [
                'required' => false,
                'label' => 'form.product.short_description',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return ProductTranslationType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductTranslationType::class];
    }
}
