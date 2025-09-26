<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait PaymentCoreFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'gateway' => 'partial',
        'method' => 'exact',
        'status' => 'exact',
        'order.id' => 'exact',
        'orderNumber' => 'partial',
        'token' => 'exact',
    ])]
    #[ApiFilter(BooleanFilter::class, properties: ['captured','refunded','active','enabled'])]
    #[ApiFilter(RangeFilter::class, properties: ['amountCents','feeCents'])]
    #[ApiFilter(OrderFilter::class, properties: ['amountCents','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $paymentCoreFilterTraitPlaceholder;
}
