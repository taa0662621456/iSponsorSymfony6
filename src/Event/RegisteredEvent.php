<?php
declare(strict_types=1);

namespace App\Event;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Contracts\EventDispatcher\Event;

class RegisteredEvent extends Event
{
    public const NAME = 'vendor.registered';

    /**
     * @var VendorSecurity
     */
    private VendorSecurity $vendorRegistered;

    /**
     * @param VendorSecurity $vendorRegistered
     */
    public function __construct(VendorSecurity $vendorRegistered)
    {
        $this->vendorRegistered = $vendorRegistered;
    }

    /**
     * @return VendorSecurity
     */
    public function getVendorRegistered(): VendorSecurity
    {
        return $this->vendorRegistered;
    }
}
