<?php

namespace App\Entity\Address;

use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_street')]
#[ORM\Index(columns: ['slug'], name: 'address_street_idx')]
#[ORM\Entity(repositoryClass: AddressStreetRepository::class)]
#[ORM\HasLifecycleCallbacks]

class AddressStreetLine
{
    use ObjectBaseTrait;
}
