<?php


namespace App\Entity\Shipment;


use App\Entity\BaseTrait;
use App\Entity\Repository\Shipment\ShipmentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_method')]
#[ORM\Index(columns: ['slug'], name: 'shipment_method_idx')]
#[ORM\Entity(repositoryClass: ShipmentMethodRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ShipmentMethod
{
    use BaseTrait;



}
