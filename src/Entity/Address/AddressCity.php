<?php

namespace App\Entity\Address;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_city')]
#[ORM\Index(columns: ['slug'], name: 'address_city_idx')]
#[ORM\Entity(repositoryClass: AddressCityRepository::class)]
#[ORM\HasLifecycleCallbacks]
class AddressCity
{
    use BaseTrait;
}
