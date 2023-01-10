<?php


namespace App\Entity\Shipment;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\CoreBundle\Doctrine\ORM\ShipmentRepository;
use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment')]
#[ORM\Index(columns: ['slug'], name: 'shipment_idx')]
#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class Shipment
{
    use ObjectBaseTrait;



}
