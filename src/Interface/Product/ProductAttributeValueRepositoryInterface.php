<?php

namespace App\Interface\Product;

interface ProductAttributeValueRepositoryInterface
{
    public function findByJsonChoiceKey($key);

}
