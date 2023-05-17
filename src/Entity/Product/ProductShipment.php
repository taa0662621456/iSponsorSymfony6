<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductShipmentInterface;

#[ORM\Entity]
class ProductShipment extends ObjectSuperEntity implements ObjectInterface, ProductShipmentInterface
{
}
