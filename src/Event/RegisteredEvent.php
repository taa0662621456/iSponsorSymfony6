<?php
declare(strict_types=1);

namespace App\Event;

use App\Entity\Vendor\Vendors;
use Symfony\Contracts\EventDispatcher\Event;

class RegisteredEvent extends Event
{
    public const NAME = 'vendors.registration';

    /**
     * @var Vendors
     */
    private $vendorRegistered;

    /**
     * @param Vendors $vendorRegistered
     */
    public function __construct(Vendors $vendorRegistered)
    {
        $this->vendorRegistered = $vendorRegistered;
    }

    /**
     * @return Vendors
     */
    public function getVendorRegistered(): Vendors
    {
        return $this->vendorRegistered;
    }
}
