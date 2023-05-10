<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Interface\Product\ProductTitleInterface;
use App\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'product_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ProductEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface, ProductTitleInterface
{

}
