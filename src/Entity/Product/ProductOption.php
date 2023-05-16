<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductOptionInterface;

#[ORM\Entity]
final class ProductOption extends ObjectSuperEntity implements ObjectInterface, ProductOptionInterface
{
}
