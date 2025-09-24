<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait ShipmentCoreFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'carrier' => 'partial',
        'methodCode' => 'exact',
        'trackingNumber' => 'exact',
        'order.id' => 'exact',
    ])]
    #[ApiFilter(BooleanFilter::class, properties: ['inTransit','delivered','active','enabled'])]
    #[ApiFilter(OrderFilter::class, properties: ['shippedAt','deliveredAt','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $shipmentCoreFilterTraitPlaceholder;
}