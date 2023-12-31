<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\AttachmentTrait;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VendorProfileCover extends RootEntity
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;

    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorProfileCover')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorProfileCover;
}
