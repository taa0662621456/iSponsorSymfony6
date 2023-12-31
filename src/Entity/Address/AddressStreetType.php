<?php

namespace App\Entity\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
class AddressStreetType extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
}
