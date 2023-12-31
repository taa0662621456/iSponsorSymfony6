<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductTaxationInterface;

#[ORM\Entity]
class ProductTaxation extends RootEntity implements ObjectInterface, ProductTaxationInterface
{
}
