<?php

namespace App\Entity\Product;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\ProductLanguageTrait;
use App\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'product_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
    "productName" => "partial",
    "productSDesc" => "partial",
    "productDesc" => "partial",
])]
class ProductEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;
}
