<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Attribute\Groups;

trait SlugTitleFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'slug' => 'exact',
        'title' => 'partial'
    ])]
    #[Groups(['read','list'])]
    private $slugTitleFilter;
}
