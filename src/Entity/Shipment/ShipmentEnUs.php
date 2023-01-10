<?php


namespace App\Entity\Shipment;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_enus')]
#[ORM\Index(columns: ['slug'], name: 'shipment_enus_idx')]
#[ORM\Entity(repositoryClass: ShipmentEnUsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class ShipmentEnUs
{
    use ObjectBaseTrait;
}
