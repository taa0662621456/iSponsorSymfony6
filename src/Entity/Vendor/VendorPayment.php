<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorPaymentInterface;

/**
 * Class VendorPayment.
 */
#[ORM\Entity]
final class VendorPayment extends ObjectSuperEntity implements ObjectInterface, VendorPaymentInterface
{
}
