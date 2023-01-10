<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Interface\Product\ProductOptionInterface;
use App\Repository\Product\ProductOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_option')]
#[ORM\Index(columns: ['slug'], name: 'product_option_idx')]
#[ORM\Entity(repositoryClass: ProductOptionRepository::class)]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class ProductOption implements ProductOptionInterface
{
    use ObjectBaseTrait;
}
