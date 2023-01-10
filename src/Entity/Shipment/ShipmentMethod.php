<?php


namespace App\Entity\Shipment;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\Repository\Shipment\ShipmentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_method')]
#[ORM\Index(columns: ['slug'], name: 'shipment_method_idx')]
#[ORM\Entity(repositoryClass: ShipmentMethodRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ShipmentMethod
{
    use ObjectBaseTrait;



}
