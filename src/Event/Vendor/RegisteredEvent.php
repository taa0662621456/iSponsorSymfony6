<?php


namespace App\Event\Vendor;

use App\Entity\Vendor\VendorSecurity;
use App\Event\VendorEvent;

class RegisteredEvent extends VendorEvent
{
    public function __construct(private readonly VendorSecurity $vendorRegistered)
    {
    }

    public function getVendorRegistered(): VendorSecurity
    {
        return $this->vendorRegistered;
    }
}
