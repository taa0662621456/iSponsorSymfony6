<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorShipmentInterface;

/**
 * Class VendorShipment.
 */
#[ORM\Entity]
class VendorShipment extends ObjectSuperEntity implements ObjectInterface, VendorShipmentInterface
{
}
