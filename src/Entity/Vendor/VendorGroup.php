<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class VendorGroup extends RootEntity implements ObjectInterface
{
}
