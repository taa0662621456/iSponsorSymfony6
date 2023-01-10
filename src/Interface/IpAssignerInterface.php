<?php

namespace App\Interface;

use App\Interface\Order\OrderInterface;
use Symfony\Component\HttpFoundation\Request;

interface IpAssignerInterface
{
    public function assign(OrderInterface $order, Request $request): void;

}
