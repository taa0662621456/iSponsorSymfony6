<?php


namespace App\Extension;



final class PromotionFilterCollectionTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('taxons_filter', TaxonFilterConfigurationType::class, [
            'label' => false,
            'required' => false,
        ]);
        $builder->add('products_filter', ProductFilterConfigurationType::class, [
            'label' => false,
            'required' => false,
        ]);
    }

    public function getExtendedType(): string
    {
        return PromotionFilterCollectionType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PromotionFilterCollectionType::class];
    }
}