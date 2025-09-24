<?php

namespace App\Service\Order;

use Symfony\Component\HttpFoundation\Request;

final class CustomerIpOrderAssigner
{
    public function assign($order, Request $request): void
    {
        $order->setCustomerIp($request->getClientIp());
    }
}