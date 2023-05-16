<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorShipmentInterface;

/**
 * Class VendorShipment.
 */
#[ORM\Entity]
final class VendorShipment extends ObjectSuperEntity implements ObjectInterface, VendorShipmentInterface
{
}
