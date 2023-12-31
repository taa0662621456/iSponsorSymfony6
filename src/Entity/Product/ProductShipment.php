<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductShipmentInterface;

#[ORM\Entity]
class ProductShipment extends RootEntity implements ObjectInterface, ProductShipmentInterface
{
}
