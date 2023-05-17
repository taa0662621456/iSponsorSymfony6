<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductTaxationInterface;

#[ORM\Entity]
class ProductTaxation extends ObjectSuperEntity implements ObjectInterface, ProductTaxationInterface
{
}
