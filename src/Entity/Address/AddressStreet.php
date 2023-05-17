<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\EntityInterface\Address\AddressStreetInterface;

#[ORM\Entity]
class AddressStreet extends ObjectSuperEntity implements AddressStreetInterface
{
}
