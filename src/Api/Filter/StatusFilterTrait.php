<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

trait StatusFilterTrait
{
    #[ApiFilter(BooleanFilter::class, properties: ['isActive','enabled'])]
    #[ApiFilter(SearchFilter::class, properties: ['status' => 'exact'])]
    private $statusFilter;
}