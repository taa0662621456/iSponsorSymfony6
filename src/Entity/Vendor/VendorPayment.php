<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorPaymentInterface;

/**
 * Class VendorPayment.
 */
#[ORM\Entity]
class VendorPayment extends RootEntity implements ObjectInterface, VendorPaymentInterface
{
}
