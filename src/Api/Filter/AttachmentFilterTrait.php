<?php
namespace App\Api\Filter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;

trait AttachmentFilterTrait
{
    #[ApiFilter(SearchFilter::class, properties: [
        'mimeType' => 'partial',
        'extension' => 'partial',
        'path' => 'partial',
        'vendor.id' => 'exact',
        'product.id' => 'exact',
        'category.id' => 'exact',
        'project.id' => 'exact',
    ])]
    #[ApiFilter(RangeFilter::class, properties: ['sizeBytes'])]
    #[ApiFilter(OrderFilter::class, properties: ['createdAt','sizeBytes'], arguments: ['orderParameterName' => 'order'])]
    #[Groups(['read','list'])]
    private $attachmentFilterTraitPlaceholder;
}
