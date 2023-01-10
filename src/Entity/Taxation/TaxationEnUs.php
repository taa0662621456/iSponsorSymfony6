<?php

namespace App\Entity\Taxation;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation')]
#[ORM\Index(columns: ['slug'], name: 'taxation_idx')]
#[ORM\Entity(repositoryClass: TaxationEnUsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class TaxationEnUs
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

}
