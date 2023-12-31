<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductOptionInterface;

#[ORM\Entity]
class ProductOption extends RootEntity implements ObjectInterface, ProductOptionInterface
{
}
