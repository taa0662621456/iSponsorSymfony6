<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorDocumentInterface;

#[ORM\Entity]
class VendorDocumentAttachment extends RootEntity implements ObjectInterface, VendorDocumentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocumentAttachment')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorDocumentAttachment;
}
