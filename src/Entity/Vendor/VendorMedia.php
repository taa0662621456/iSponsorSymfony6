<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorMediaInterface;

#[ORM\Entity]
class VendorMedia extends RootEntity implements ObjectInterface, VendorMediaInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMedia')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorMediaVendor;
}
