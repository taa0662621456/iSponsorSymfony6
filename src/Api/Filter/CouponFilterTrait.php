<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait CouponFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: ['code' => 'exact','title' => 'partial'])]
    #[ApiFilter(BooleanFilter::class, properties: ['active','published'])]
    #[ApiFilter(DateFilter::class, properties: ['startsAt','endsAt'])]
    #[ApiFilter(RangeFilter::class, properties: ['discountPercent','discountCents','usageLeft'])]
    #[Groups(['read','list'])]
    private $couponFilterTraitPlaceholder;
}