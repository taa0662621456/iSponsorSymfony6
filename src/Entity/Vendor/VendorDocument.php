<?php

namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorDocumentInterface;

#[ORM\Entity]
class VendorDocument extends ObjectSuperEntity implements ObjectInterface, VendorDocumentInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocument')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorDocumentVendor;
}
