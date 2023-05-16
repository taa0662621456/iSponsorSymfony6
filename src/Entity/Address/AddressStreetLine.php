<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Address\AddressStreetInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
final class AddressStreetLine extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressStreetInterface
{
}
