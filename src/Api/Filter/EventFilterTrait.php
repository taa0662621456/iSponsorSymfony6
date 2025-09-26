<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait EventFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'type' => 'exact',
        'member.email' => 'partial',
        'vendor.id' => 'exact',
        'project.id' => 'exact',
        'product.id' => 'exact',
    ])]
    #[ApiFilter(DateFilter::class, properties: ['startedAt','endedAt','createdAt'])]
    #[ApiFilter(OrderFilter::class, properties: ['startedAt','endedAt','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $eventFilterTraitPlaceholder;
}
