<?php

namespace App\Interface\Object;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    /*    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'project:list']]],
        itemOperations: ['get' => ['normalization_context' => ['groups' => 'project:item']]],*/
    order: ['createdAt' => 'DESC'],
    paginationEnabled: true
)]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
])]
interface ObjectApiResourceInterface
{

}
