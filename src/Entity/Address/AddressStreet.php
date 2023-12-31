<?php

namespace App\Entity\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Address\AddressStreetInterface;

#[ORM\Entity]
class AddressStreet extends RootEntity implements AddressStreetInterface
{
}
