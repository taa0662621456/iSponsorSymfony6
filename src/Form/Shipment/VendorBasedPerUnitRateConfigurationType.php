<?php


namespace App\Form\Shipment;


use App\Form\Shipment\Calculator\PerUnitRateConfigurationType;
use App\Interface\Vendor\VendorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class VendorBasedPerUnitRateConfigurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => PerUnitRateConfigurationType::class,
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
        return 'channel_based_shipping_calculator_per_unit_rate';
    }
}
