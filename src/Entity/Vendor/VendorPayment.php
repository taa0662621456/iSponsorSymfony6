<?php

namespace App\Entity\Vendor;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorPaymentInterface;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VendorPayment.
 */
#[ORM\Table(name: 'vendor_payment')]
#[ORM\Index(columns: ['slug'], name: 'vendor_payment_idx')]
#[ORM\Entity(repositoryClass: VendorMessageRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class VendorPayment extends ObjectSuperEntity implements ObjectInterface, VendorPaymentInterface
{
}
