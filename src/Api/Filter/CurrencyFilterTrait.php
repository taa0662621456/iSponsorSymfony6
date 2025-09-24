<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait CurrencyFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'code' => 'exact',        // ISO 4217 (e.g. USD)
        'numericCode' => 'exact', // 840
        'symbol' => 'partial',
    ])]
    #[ApiFilter(BooleanFilter::class, properties: ['enabled','default'])]
    #[ApiFilter(RangeFilter::class, properties: ['rate'])]
    #[ApiFilter(OrderFilter::class, properties: ['rate','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $currencyFilterTraitPlaceholder;
}
