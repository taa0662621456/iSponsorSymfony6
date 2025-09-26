<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait ReviewFilterTrait
{
    #[ApiFilter(RangeFilter::class, properties: ['rating'])]
    #[ApiFilter(BooleanFilter::class, properties: ['published','verified'])]
    #[ApiFilter(SearchFilter::class, properties: [
        'author.email' => 'partial',
        'product.id' => 'exact',
        'project.id' => 'exact',
    ])]
    #[Groups(['read','list'])]
    private $reviewFilterTraitPlaceholder;
}
