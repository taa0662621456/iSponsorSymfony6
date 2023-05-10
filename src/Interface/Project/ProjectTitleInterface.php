<?php

namespace App\Interface\Project;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ApiFilter(SearchFilter::class, properties: [
    'projectTitle' => 'partial',
    'projectSDesc' => 'partial',
    'projectDesc' => 'partial',
])]
interface ProjectTitleInterface
{

}
