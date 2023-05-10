<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Interface\Address\AddressStreetInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\AddressStreetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address_street')]
#[ORM\Index(columns: ['slug'], name: 'address_street_idx')]
#[ORM\Entity(repositoryClass: AddressStreetRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class AddressStreetLine extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressStreetInterface
{
}
