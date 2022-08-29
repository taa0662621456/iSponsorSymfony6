<?php


namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_document')]
#[ORM\Index(columns: ['slug'], name: 'vendor_document_idx')]
#[ORM\Entity(repositoryClass: VendorDocumentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorDocument
{
	use BaseTrait;
    use ObjectTrait;
	use AttachmentTrait;

	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocument')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Vendor $vendorDocumentVendor;
    # ManyToOne
	public function getVendorDocumentVendor(): Vendor
    {
		return $this->vendorDocumentVendor;
	}
	public function setVendorDocumentVendor(Vendor $vendorDocumentVendor): void
	{
		$this->vendorDocumentVendor = $vendorDocumentVendor;
	}
}
