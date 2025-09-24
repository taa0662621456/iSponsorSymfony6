<?php

namespace App\Service;

use App\Entity\Vendor\Vendor;

interface OrderFactoryInterface
{
    public function placeFromCheckout(Vendor $vendor, ?string $idempotencyKey = null): Order;
}