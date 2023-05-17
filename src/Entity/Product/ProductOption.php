<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductOptionInterface;

#[ORM\Entity]
class ProductOption extends ObjectSuperEntity implements ObjectInterface, ProductOptionInterface
{
}
