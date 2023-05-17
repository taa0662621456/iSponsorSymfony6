<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class VendorGroup extends ObjectSuperEntity implements ObjectInterface
{
}
