<?php

namespace App\Entity\Vendor;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorShipmentInterface;
use App\Repository\Vendor\VendorShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VendorShipment.
 */
#[ORM\Table(name: 'vendor_shipment')]
#[ORM\Index(columns: ['slug'], name: 'vendor_shipment_idx')]
#[ORM\Entity(repositoryClass: VendorShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class VendorShipment extends ObjectSuperEntity implements ObjectInterface, VendorShipmentInterface
{

}
