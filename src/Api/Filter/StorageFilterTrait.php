<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait StorageFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'disk' => 'exact',
        'visibility' => 'exact',
        'path' => 'partial',
    ])]
    #[ApiFilter(OrderFilter::class, properties: ['createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $storageFilterTraitPlaceholder;
}