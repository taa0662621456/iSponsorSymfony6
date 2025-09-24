<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Attribute\Groups;

trait PriceFilterTrait
{
    #[ApiFilter(RangeFilter::class, properties: [
        'orderTotal',
        'orderDiscount',
        'orderCouponDiscount',
        'orderBillTaxAmount',
        'orderBillDiscountAmount',
        'price',
        'amount',
    ])]
    #[ApiFilter(OrderFilter::class, properties: [
        'orderTotal',
        'price',
        'totalCents',
        'amountCents'
    ], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list','item'])]
    private $priceFilterTraitPlaceholder;
}