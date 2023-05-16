<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Interface\Product\ProductTitleInterface;

#[ORM\Entity]
final class ProductEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface, ProductTitleInterface
{
}
