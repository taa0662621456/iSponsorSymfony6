<?php

namespace App\Entity\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Entity\AttachmentTrait;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorDocumentInterface;
use App\Repository\Vendor\VendorDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_document')]
#[ORM\Index(columns: ['slug'], name: 'vendor_document_idx')]
#[ORM\Entity(repositoryClass: VendorDocumentRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource(mercure: true)]
final class VendorDocument extends ObjectSuperEntity implements ObjectInterface, VendorDocumentInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocument')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorDocumentVendor;

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
