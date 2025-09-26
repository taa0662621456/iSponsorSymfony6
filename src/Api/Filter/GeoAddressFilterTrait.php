<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait GeoAddressFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'country.code' => 'exact',
        'province.code' => 'exact',
        'city.name' => 'partial',
        'zipcode.code' => 'exact',
        'streetLine' => 'partial',
        'streetSecondLine' => 'partial',
    ])]
    #[ApiFilter(DateFilter::class, properties: ['createdAt','modifiedAt'])]
    #[ApiFilter(OrderFilter::class, properties: ['createdAt','modifiedAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $geoAddressFilterTraitPlaceholder;
}
