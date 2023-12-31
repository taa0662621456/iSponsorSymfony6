<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorShipmentInterface;

/**
 * Class VendorShipment.
 */
#[ORM\Entity]
class VendorShipment extends RootEntity implements ObjectInterface, VendorShipmentInterface
{
}
