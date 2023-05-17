<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\EntityInterface\Address\AddressCodeInterface;

#[ORM\Entity]
class AddressCode extends ObjectSuperEntity implements AddressCodeInterface
{
}
