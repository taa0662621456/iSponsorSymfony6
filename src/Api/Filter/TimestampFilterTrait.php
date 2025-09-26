<?php

namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Attribute\Groups;

trait TimestampFilterTrait
{
    #[ApiFilter(OrderFilter::class, properties: ['createdAt','modifiedAt'], arguments: ['orderParameterName' => 'order'])]
    #[ApiFilter(BooleanFilter::class, properties: ['published'])]
    #[Groups(['read','list','item'])]
    private $timestampFilterPlaceholder;
}
