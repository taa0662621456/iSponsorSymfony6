<?php

namespace App\Interface\Object;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
])]
interface ObjectTileInterface
{

}
