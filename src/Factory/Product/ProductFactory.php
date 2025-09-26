<?php

namespace App\Factory\Product;


use App\Entity\Product\Product;

class ProductFactory
{
    public function __invoke(): Product
    {
        return new Product();
    }


    public static function create(): Product
    {
        return new Product();
    }

}
