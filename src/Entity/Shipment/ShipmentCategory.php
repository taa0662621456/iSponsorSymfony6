<?php


namespace App\Entity\Shipment;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\Repository\Shipment\ShipmentCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_category')]
#[ORM\Index(columns: ['slug'], name: 'shipment_category_idx')]
#[ORM\Entity(repositoryClass: ShipmentCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ShipmentCategory
{
    use ObjectBaseTrait;



}
