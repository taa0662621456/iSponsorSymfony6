<?php


namespace App\Event;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Contracts\EventDispatcher\Event;

class RegisteredEvent extends Event
{
    public const NAME = 'vendor.registered';

    public function __construct(private VendorSecurity $vendorRegistered)
    {
    }

    public function getVendorRegistered(): VendorSecurity
    {
        return $this->vendorRegistered;
    }
}
