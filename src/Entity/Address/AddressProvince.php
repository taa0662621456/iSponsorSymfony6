<?php

namespace App\Entity\Address;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_province')]
#[ORM\Index(columns: ['slug'], name: 'address_province_idx')]
#[ORM\Entity(repositoryClass: AddressProvinceRepository::class)]
#[ORM\HasLifecycleCallbacks]

class AddressProvince
{
    use BaseTrait;
}
