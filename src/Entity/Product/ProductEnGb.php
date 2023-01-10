<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Entity\ProductLanguageTrait;
use App\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'product_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
    'productName' => 'partial',
    'productSDesc' => 'partial',
    'productDesc' => 'partial',
])]
class ProductEnGb
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use ProductLanguageTrait;
}
