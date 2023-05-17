<?php

namespace App\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class TaxRateTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('zone', ZoneChoiceType::class, ['zone_scope' => Scope::TAX]);
    }

    public function getExtendedType(): string
    {
        return TaxationRateType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [TaxRateType::class];
    }
}
