<?php

namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorMediaInterface;

#[ORM\Entity]
final class VendorMedia extends ObjectSuperEntity implements ObjectInterface, VendorMediaInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMedia')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorMediaVendor;

    // ManyToOne
    public function getVendorMediaVendor(): Vendor
    {
        return $this->vendorMediaVendor;
    }

    public function setVendorMediaVendor(Vendor $vendorMediaVendor): void
    {
        $this->vendorMediaVendor = $vendorMediaVendor;
    }
}
