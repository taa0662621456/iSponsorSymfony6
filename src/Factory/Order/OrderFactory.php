<?php

namespace App\Factory\Order;


use App\Entity\Product\Order;

class OrderFactory
{
    public function __invoke(): Order
    {
        return new Order();
    }


    public static function create(): Order
    {
        return new Order();
    }

}
