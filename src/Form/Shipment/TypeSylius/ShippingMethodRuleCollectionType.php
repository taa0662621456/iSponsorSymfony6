<?php


namespace App\Form\Shipment\TypeSylius;


use App\Form\Shipment\Core\AbstractConfigurationCollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShippingMethodRuleCollectionType extends AbstractConfigurationCollectionType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('entry_type', ShippingMethodRuleType::class);
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_rule_collection';
    }
}
