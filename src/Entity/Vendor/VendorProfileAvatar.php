<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\AttachmentTrait;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VendorProfileAvatar extends RootEntity
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorProfileAvatar')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorProfileAvatar;
}