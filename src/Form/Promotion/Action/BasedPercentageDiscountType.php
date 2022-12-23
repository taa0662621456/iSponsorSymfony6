<?php


namespace App\CoreBundle\Form\Type\Promotion\Action;


use App\Interface\Vendor\VendorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BasedPercentageDiscountType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => UnitPercentageDiscountType::class,
            'entry_options' => fn (VendorInterface $vendor) => [
                'label' => $vendor->getName(),
                'currency' => $vendor->getBaseCurrency()->getCode(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return VendorCollectionType::class;
    }
}
