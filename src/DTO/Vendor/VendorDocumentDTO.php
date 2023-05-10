<?php

namespace App\DTO\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Entity\Vendor\Vendor;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(mercure: true)]
final class VendorDocumentDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    private Vendor $vendorDocumentVendor;

    // ManyToOne
    public function getVendorDocumentVendor(): Vendor
    {
        return $this->vendorDocumentVendor;
    }

    public function setVendorDocumentVendor(Vendor $vendorDocumentVendor): void
    {
        $this->vendorDocumentVendor = $vendorDocumentVendor;
    }
}
