<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait CodeNameFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'code' => 'exact',
        'name' => 'partial',
    ])]
    #[Groups(['read','list'])]
    private $codeNameFilterTraitPlaceholder;
}