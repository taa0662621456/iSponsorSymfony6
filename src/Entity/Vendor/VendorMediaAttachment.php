<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorMediaInterface;

#[ORM\Entity]
class VendorMediaAttachment extends RootEntity implements ObjectInterface, VendorMediaInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;

    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMediaAttachment')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorMediaAttachment;
}
