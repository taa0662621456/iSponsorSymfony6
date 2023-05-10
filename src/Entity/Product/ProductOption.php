<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductOptionInterface;
use App\Repository\Product\ProductOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_option')]
#[ORM\Index(columns: ['slug'], name: 'product_option_idx')]
#[ORM\Entity(repositoryClass: ProductOptionRepository::class)]
final class ProductOption extends ObjectSuperEntity implements ObjectInterface, ProductOptionInterface
{
}
