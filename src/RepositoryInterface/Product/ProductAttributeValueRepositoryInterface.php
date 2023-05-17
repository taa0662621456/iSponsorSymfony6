<?php

namespace App\RepositoryInterface\Product;

use App\RepositoryInterface\EntityRepositoryInterface;

interface ProductAttributeValueRepositoryInterface extends EntityRepositoryInterface
{
    public function findByJsonChoiceKey($key);

}
