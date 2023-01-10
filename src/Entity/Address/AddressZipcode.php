<?php

namespace App\Entity\Address;

use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_code')]
#[ORM\Index(columns: ['slug'], name: 'address_code_idx')]
#[ORM\Entity(repositoryClass: AddressCodeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class AddressZipcode
{
    use ObjectBaseTrait;
}
