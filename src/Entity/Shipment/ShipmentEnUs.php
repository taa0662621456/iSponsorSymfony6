<?php


namespace App\Entity\Shipment;


use App\Entity\BaseTrait;
use App\Entity\Repository\Shipment\ShipmentEnUsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_enus')]
#[ORM\Index(columns: ['slug'], name: 'shipment_enus_idx')]
#[ORM\Entity(repositoryClass: ShipmentEnUsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ShipmentEnUs
{
    use BaseTrait;
}
