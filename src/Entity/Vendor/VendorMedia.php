<?php

namespace App\Entity\Vendor;

use App\Entity\ObjectSuperEntity;
use App\Entity\AttachmentTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorMediaInterface;
use App\Repository\Vendor\VendorMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_media')]
#[ORM\Index(columns: ['slug'], name: 'vendor_media_idx')]
#[ORM\Entity(repositoryClass: VendorMediaRepository::class)]
#[ORM\HasLifecycleCallbacks]
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
