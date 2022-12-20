<?php

namespace App\Factory\Category;


use App\Entity\Category\Category;

class CategoryFactory
{
    public function __invoke(): Category
    {
        return new Category();
    }

    public static function create(): Category
    {
        return new Category();
    }

}
