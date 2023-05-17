<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Address\AddressStreetInterface;

#[ORM\Entity]
class AddressStreetLine extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressStreetInterface
{
}
