<?php

namespace App\Service\Shipment;

use Doctrine\Persistence\ObjectRepository;

final class ShipmentMethodsResolver
{
    public function __construct(
        private readonly ObjectRepository $shippingMethodRepository,
        private                           $eligibilityChecker,
    ) {
    }

    public function getSupportedMethods($subject): array
    {
        $methods = [];

        foreach ($this->shippingMethodRepository->findBy(['enabled' => true]) as $shippingMethod) {
            if ($this->eligibilityChecker->isEligible($subject, $shippingMethod)) {
                $methods[] = $shippingMethod;
            }
        }

        return $methods;
    }

    public function supports($subject): bool
    {
        return true;
    }
}
