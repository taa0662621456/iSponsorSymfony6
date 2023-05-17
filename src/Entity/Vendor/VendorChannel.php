<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class VendorChannel extends ObjectSuperEntity implements ObjectInterface
{
}
