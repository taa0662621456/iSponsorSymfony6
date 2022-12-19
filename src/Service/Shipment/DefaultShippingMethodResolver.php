<?php

namespace App\Service\Shipment;

use App\Exception\DefaultShippingMethodUnresolvedException;

final class DefaultShippingMethodResolver
{
    public function __construct(private $shippingMethodRepository)
    {
    }

    /**
     * @throws DefaultShippingMethodUnresolvedException
     */
    public function getDefaultShippingMethod($shipment): ShippingMethodInterface
    {
        $shippingMethods = $this->shippingMethodRepository->findBy(['enabled' => true]);
        if (empty($shippingMethods)) {
            throw new DefaultShippingMethodUnresolvedException();
        }

        return $shippingMethods[0];
    }
}
