<?php
declare(strict_types=1);

namespace App\Event;

use App\Entity\Vendor\Vendor;
use Symfony\Contracts\EventDispatcher\Event;

class RegisteredEvent extends Event
{
    public const NAME = 'vendor.registration';

    /**
     * @var Vendor
     */
    private Vendor $vendorRegistered;

    /**
     * @param Vendor $vendorRegistered
     */
    public function __construct(Vendor $vendorRegistered)
    {
        $this->vendorRegistered = $vendorRegistered;
    }

    /**
     * @return Vendor
     */
    public function getVendorRegistered(): Vendor
    {
        return $this->vendorRegistered;
    }
}
