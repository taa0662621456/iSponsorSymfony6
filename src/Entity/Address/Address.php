<?php

namespace App\Entity\Address;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Interface\Address\AddressInterface;
use App\Repository\Address\AddressCountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address')]
#[ORM\Index(columns: ['slug'], name: 'address_idx')]
#[ORM\Entity(repositoryClass: AddressCountryRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
])]
class Address implements AddressInterface
{
    use ObjectBaseTrait;
}
