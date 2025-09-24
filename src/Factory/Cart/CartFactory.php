<?php

namespace App\Factory\Cart;

class CartFactory
{
    public function __invoke(): Cart
    {
        return new Cart();
    }


    public static function create(): Cart
    {
        return new Cart();
    }

}