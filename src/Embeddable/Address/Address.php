<?php

namespace App\Embeddable\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\Interface\Object\ObjectApiResourceInterface;

class Address extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
}
