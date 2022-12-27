<?php

namespace App\Entity\Property;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'property')]
#[ORM\Index(columns: ['slug'], name: 'property_idx')]
#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class Property
{

    use BaseTrait;
    use ObjectTrait;

}
