<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductShipmentInterface;

#[ORM\Entity]
final class ProductShipment extends ObjectSuperEntity implements ObjectInterface, ProductShipmentInterface
{
}
