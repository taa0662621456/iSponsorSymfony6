<?php

namespace App\EntityInterface\Order;

interface OrderCheckoutStatesInterface
{
    public const ORDER_STATE_ADDRESSED = 'addressed';

    public const ORDER_STATE_CART = 'cart';

    public const ORDER_STATE_COMPLETED = 'completed';

    public const ORDER_STATE_PAYMENT_SELECTED = 'payment_selected';

    public const ORDER_STATE_PAYMENT_SKIPPED = 'payment_skipped';

    public const ORDER_STATE_SHIPPING_SELECTED = 'shipping_selected';

    public const ORDER_STATE_SHIPPING_SKIPPED = 'shipping_skipped';
}
