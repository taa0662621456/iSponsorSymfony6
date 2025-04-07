<?php

namespace App\EntityInterface\Shipment;

interface ShipmentInterface
{
    const STATE_CART = '';
    const STATE_READY = '';
    const STATE_SHIPPED = '';
    const STATE_CANCELLED = '';
}
