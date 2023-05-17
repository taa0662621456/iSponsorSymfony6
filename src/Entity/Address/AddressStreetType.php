<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
class AddressStreetType extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
}
