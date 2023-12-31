<?php

namespace App\Entity\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Address\AddressCodeInterface;

#[ORM\Entity]
class AddressCode extends RootEntity implements AddressCodeInterface
{
}
