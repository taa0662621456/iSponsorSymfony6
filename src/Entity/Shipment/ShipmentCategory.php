<?php

namespace App\Entity\Shipment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Shipment\ShipmentCategoryInterface;
use App\Repository\Shipment\ShipmentCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_category')]
#[ORM\Index(columns: ['slug'], name: 'shipment_category_idx')]
#[ORM\Entity(repositoryClass: ShipmentCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ShipmentCategory extends ObjectSuperEntity implements ObjectInterface, ShipmentCategoryInterface
{
}
