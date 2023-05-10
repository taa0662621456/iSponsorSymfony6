<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Interface\Address\AddressZipcodeInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\AddressCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address_code')]
#[ORM\Index(columns: ['slug'], name: 'address_code_idx')]
#[ORM\Entity(repositoryClass: AddressCodeRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class AddressZipcode extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressZipcodeInterface
{

}
