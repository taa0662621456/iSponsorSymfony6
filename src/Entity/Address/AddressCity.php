<?php

namespace App\Entity\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Address\AddressCityInterface;

#[ORM\Entity]
class AddressCity extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, AddressCityInterface
{
}
