<?php

namespace App\Service\Shipment;

final class CompositeShipmentMethodsResolver
{
    public function __construct(private $resolversRegistry)
    {
    }

    public function getSupportedMethods($subject): array
    {
        /** @var ShippingMethodsResolverInterface $resolver */
        foreach ($this->resolversRegistry->all() as $resolver) {
            if ($resolver->supports($subject)) {
                return $resolver->getSupportedMethods($subject);
            }
        }

        return [];
    }

    public function supports($subject): bool
    {
        /** @var $resolver */
        foreach ($this->resolversRegistry->all() as $resolver) {
            if ($resolver->supports($subject)) {
                return true;
            }
        }

        return false;
    }
}
