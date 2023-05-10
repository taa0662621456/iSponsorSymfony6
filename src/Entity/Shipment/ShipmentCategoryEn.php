<?php

namespace App\Entity\Shipment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\ShipmentCategoryEnRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_category_en')]
#[ORM\Index(columns: ['slug'], name: 'shipment_category_en_idx')]
#[ORM\Entity(repositoryClass: ShipmentCategoryEnRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ShipmentCategoryEn extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{

}
