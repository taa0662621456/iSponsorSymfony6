<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
class VendorShopUser extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
    use VendorLanguageTrait;
}
