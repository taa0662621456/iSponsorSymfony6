<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

trait CommonFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'token' => 'exact',
        'vendor.email' => 'partial',
        'scope' => 'partial',
    ])]
    #[ApiFilter(BooleanFilter::class, properties: ['published'])]
    #[ApiFilter(DateFilter::class, properties: ['createdAt','modifiedAt','lastRequestAt'])]
    # Сортировка
    #[ApiFilter(OrderFilter::class, properties: ['createdAt','modifiedAt','lastRequestAt'], arguments: ['orderParameterName' => 'order'])]
    private $commonFilterTraitPlaceholder;
}