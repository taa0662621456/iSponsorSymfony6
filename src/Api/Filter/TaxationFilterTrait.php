<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait TaxationFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'code' => 'exact',
        'category.code' => 'exact',
        'zone.code' => 'exact',
        'strategy' => 'exact',
    ])]
    #[ApiFilter(RangeFilter::class, properties: ['rate','amount','threshold'])]
    #[ApiFilter(OrderFilter::class, properties: ['rate','amount','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $taxationFilterTraitPlaceholder;
}