<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait ModuleMenuFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'module.code' => 'exact',
        'module.name' => 'partial',
        'name' => 'partial',
        'route' => 'partial',
    ])]
    #[ApiFilter(OrderFilter::class, properties: ['position','createdAt'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $moduleMenuFilterTraitPlaceholder;
}