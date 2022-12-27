<?php

namespace App\Entity\Address;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address')]
#[ORM\Index(columns: ['slug'], name: 'address_idx')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class Address
{
    use BaseTrait;
}
