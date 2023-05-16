<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductTaxationInterface;

#[ORM\Entity]
final class ProductTaxation extends ObjectSuperEntity implements ObjectInterface, ProductTaxationInterface
{
}
