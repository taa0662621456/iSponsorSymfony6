<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Interface\Address\AddressCityInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\AddressCityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address_city')]
#[ORM\Index(columns: ['slug'], name: 'address_city_idx')]
#[ORM\Entity(repositoryClass: AddressCityRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class AddressCity extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressCityInterface
{
}
