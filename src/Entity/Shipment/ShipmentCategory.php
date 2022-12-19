<?php


namespace App\Entity\Shipment;


use App\Entity\BaseTrait;
use App\Entity\Repository\Shipment\ShipmentCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_category')]
#[ORM\Index(columns: ['slug'], name: 'shipment_category_idx')]
#[ORM\Entity(repositoryClass: ShipmentCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ShipmentCategory
{
    use BaseTrait;



}
