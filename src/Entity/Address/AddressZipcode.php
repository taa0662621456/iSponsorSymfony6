<?php

namespace App\Entity\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Address\AddressZipcodeInterface;

#[ORM\Entity]
class AddressZipcode extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, AddressZipcodeInterface
{
}
