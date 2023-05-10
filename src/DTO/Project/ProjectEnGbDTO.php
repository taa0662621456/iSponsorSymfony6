<?php

namespace App\DTO\Project;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
    'projectTitle' => 'partial',
    'projectSDesc' => 'partial',
    'projectDesc' => 'partial',
])]
final class ProjectEnGbDTO extends ObjectDTO implements ObjectApiResourceInterface
{
}
