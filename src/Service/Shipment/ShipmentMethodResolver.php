<?php

namespace App\Service\Shipment;

use App\Repository\Shipment\ShipmentMethodRepository;
use App\Interface\Shipment\ShipmentMethodResolverInterface;

final class ShipmentMethodResolver implements ShipmentMethodResolverInterface
{
    public function __construct(
        private readonly ShipmentMethodRepository $shipmentMethodRepository,
        private $eligibilityChecker = '',
    ) {
    }

    public function getSupportedMethods($subject): array
    {
        $methods = [];

        foreach ($this->shipmentMethodRepository->findBy(['enabled' => true]) as $shippingMethod) {
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
