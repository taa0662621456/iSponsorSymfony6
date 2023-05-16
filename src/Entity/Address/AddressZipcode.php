<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Address\AddressZipcodeInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
final class AddressZipcode extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressZipcodeInterface
{
}
