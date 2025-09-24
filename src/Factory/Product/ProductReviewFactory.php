<?php

namespace App\Factory\Product;

use App\Entity\Product\ProductReview;


class ProductReviewFactory
{
    public function __invoke(): ProductReviewFactory
    {
        return new ProductReviewFactory();
    }


    public static function create(): ProductReviewFactory
    {
        return new ProductReviewFactory();
    }

}