<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait LocalizedTitleFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'title' => 'partial',
        'firstTitle' => 'partial',
        'lastTitle' => 'partial',
        'locale' => 'exact',
        'lang' => 'exact',
    ])]
    #[Groups(['read','list'])]
    private $localizedTitleFilterTraitPlaceholder;
}
