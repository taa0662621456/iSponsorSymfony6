<?php

namespace App\Entity\Shipment;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_category_en')]
#[ORM\Index(columns: ['slug'], name: 'shipment_category_en_idx')]
#[ORM\Entity(repositoryClass: ShipmentCategoryEnRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class ShipmentCategoryEn
{
    use BaseTrait;
    use ObjectTrait;

}
