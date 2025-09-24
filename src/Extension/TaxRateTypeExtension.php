<?php


namespace App\Extension;



final class TaxRateTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('zone', ZoneChoiceType::class, ['zone_scope' => Scope::TAX]);
    }

    public function getExtendedType(): string
    {
        return TaxRateType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [TaxRateType::class];
    }
}