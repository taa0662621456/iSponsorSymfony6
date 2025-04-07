<?php

namespace App\Entity\Embeddable\Address;

use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Object\ObjectApiResourceInterface;

class Address extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
}
