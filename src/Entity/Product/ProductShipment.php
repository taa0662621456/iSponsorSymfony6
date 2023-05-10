<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductShipmentInterface;
use App\Repository\Product\ProductShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_shipment')]
#[ORM\Index(columns: ['slug'], name: 'product_shipment_idx')]
#[ORM\Entity(repositoryClass: ProductShipmentRepository::class)]

final class ProductShipment extends ObjectSuperEntity implements ObjectInterface, ProductShipmentInterface
{
}
