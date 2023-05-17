<?php

namespace App\Form\Discount;

use App\EntityInterface\Vendor\VendorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class VendorBasedFixedDiscountType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => FixedDiscountActionType::class,
            'entry_options' => function (VendorInterface $vendor) {
                return [
                    'label' => $vendor->getName(),
                    'currency' => $vendor->getBaseCurrency()->getCode(),
                ];
            },
        ]);
    }

    public function getParent(): string
    {
        return VendorCollectionType::class;
    }
}
