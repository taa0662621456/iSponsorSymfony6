<?php


namespace App\Entity\Product;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\BaseTrait;
use App\Repository\Product\ProductOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_option')]
#[ORM\Index(columns: ['slug'], name: 'product_option_idx')]
#[ORM\Entity(repositoryClass: ProductOptionRepository::class)]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductOption
{
    use BaseTrait;

}
