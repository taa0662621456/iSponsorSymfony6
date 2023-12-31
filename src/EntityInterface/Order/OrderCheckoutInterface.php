<?php

namespace App\EntityInterface\Order;

interface OrderCheckoutInterface
{
    public const GRAPH = 'order_checkout';

    public const ORDER_ADDRESS = 'address';

    public const ORDER_COMPLETE = 'complete';

    public const ORDER_SELECT_PAYMENT = 'select_payment';

    public const ORDER_SELECT_SHIPMENT = 'select_shipment';

    public const ORDER_SKIP_PAYMENT = 'skip_payment';

    public const ORDER_SKIP_SHIPMENT = 'skip_shipment';
}
