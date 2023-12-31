<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorProfileInterface;

#[ORM\UniqueConstraint(name: 'vendor_profile_idx', columns: ['slug', 'vendor_phone'])]
// #[UniqueEntity(errorPath: 'vendor_phone', message: 'phone.already.use')]
// #[UniqueEntity(errorPath: 'slug', message: 'slug.already.use')]

#[ORM\Entity]
class VendorProfile extends RootEntity implements ObjectInterface, VendorProfileInterface
{
    use VendorLanguageTrait;

    #[ORM\OneToOne(inversedBy: 'vendorProfile', targetEntity: Vendor::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?Vendor $vendorProfile = null;

    public function getVendorProfile(): ?Vendor
    {
        return $this->vendorProfile;
    }

    public function setVendorProfile(?Vendor $vendorProfile): void
    {
        $this->vendorProfile = $vendorProfile;
    }
}
