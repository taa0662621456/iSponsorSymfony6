<?php

namespace App\EntityInterface\Product;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;

#[ApiFilter(SearchFilter::class, properties: [
    'productName' => 'partial',
    'productSDesc' => 'partial',
    'productDesc' => 'partial',
])]
interface ProductTitleInterface
{
}
