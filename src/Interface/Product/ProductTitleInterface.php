<?php

namespace App\Interface\Product;

use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ApiFilter(SearchFilter::class, properties: [
    'productName' => 'partial',
    'productSDesc' => 'partial',
    'productDesc' => 'partial',
])]
interface ProductTitleInterface
{

}
