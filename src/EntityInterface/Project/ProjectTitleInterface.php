<?php

namespace App\EntityInterface\Project;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ApiFilter(SearchFilter::class, properties: [
    'projectTitle' => 'partial',
    'projectSDesc' => 'partial',
    'projectDesc' => 'partial',
])]
interface ProjectTitleInterface
{
}