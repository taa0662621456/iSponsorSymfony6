<?php

namespace App\Form\Shipment;

use App\EntityInterface\Vendor\VendorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Shipment\Calculator\FlatRateConfigurationType;

final class VendorBasedFlatRateConfigurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => FlatRateConfigurationType::class,
            'entry_options' => fn (VendorInterface $vendor): array => [
                'label' => $vendor->getName(),
                'currency' => $vendor->getBaseCurrency()->getCode(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return VendorCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'channel_based_shipping_calculator_flat_rate';
    }
}
