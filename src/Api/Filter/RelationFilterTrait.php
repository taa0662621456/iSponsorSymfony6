<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Attribute\Groups;

trait RelationFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'vendor.email' => 'partial',
        'vendor.slug' => 'exact',
        'project.slug' => 'exact',
        'category.slug' => 'exact',
        'user.email' => 'partial'
    ])]
    #[Groups(['read','list'])]
    private $relationFilterTraitPlaceholder;
}
