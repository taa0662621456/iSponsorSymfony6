<?php

namespace App\Entity\Address;

use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_country')]
#[ORM\Index(columns: ['slug'], name: 'address_country_idx')]
#[ORM\Entity(repositoryClass: AddressCountryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class AddressCountry
{
    use ObjectBaseTrait;
}
