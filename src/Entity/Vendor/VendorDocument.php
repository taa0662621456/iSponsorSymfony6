<?php


namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Repository\Vendor\VendorDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendors_documents')]
#[ORM\Index(columns: ['slug'], name: 'vendor_document_idx')]
#[ORM\Entity(repositoryClass: VendorDocumentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorDocument
{
	use BaseTrait;
	use AttachmentTrait;
	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocumentAttachments')]
	#[ORM\JoinColumn(name: 'attachments_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private ?Vendor $attachments = null;

	public function getAttachments(): Vendor
    {
		return $this->attachments;
	}
	public function setAttachment(Vendor $attachments): void
	{
		$this->attachments = $attachments;
	}
}
