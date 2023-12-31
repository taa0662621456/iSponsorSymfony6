<?php

namespace App\Dto\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\Dto\Abstraction\ObjectDTO;
use App\Entity\Vendor\Vendor;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(mercure: true)]
final class VendorDocumentDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    private Vendor $vendorDocumentVendorDTO;

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