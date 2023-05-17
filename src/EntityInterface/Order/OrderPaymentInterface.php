<?php

namespace App\EntityInterface\Order;

interface OrderPaymentInterface
{
    public const GRAPH = 'order_payment';

    public const ORDER_REQUEST_PAYMENT = 'request_payment';

    public const ORDER_PARTIALLY_AUTHORIZE = 'partially_authorize';

    public const ORDER_AUTHORIZE = 'authorize';

    public const ORDER_PARTIALLY_PAY = 'partially_pay';

    public const ORDER_CANCEL = 'cancel';

    public const ORDER_PAY = 'pay';

    public const ORDER_PARTIALLY_REFUND = 'partially_refund';

    public const ORDER_REFUND = 'refund';

    public const ORDER_COMPLETE = 'complete';

}
