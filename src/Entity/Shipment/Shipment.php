<?php


namespace App\Entity\Shipment;


use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment')]
#[ORM\Index(columns: ['slug'], name: 'shipment_idx')]
#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Shipment
{
    use BaseTrait;



}
