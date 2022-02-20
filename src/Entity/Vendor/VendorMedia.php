<?php


namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendors_medias')]
#[ORM\Index(columns: ['slug'], name: 'vendor_media_idx')]
#[ORM\Entity(repositoryClass: \App\Repository\Vendor\VendorMediaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorMedia
{
	use BaseTrait;
	use AttachmentTrait;
	#[ORM\ManyToOne(targetEntity: \App\Entity\Vendor\Vendor::class, inversedBy: 'vendorMediaAttachments')]
	#[ORM\JoinColumn(name: 'attachments_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	private Vendor $attachments;
	public function getAttachments(): Vendor
    {
		return $this->attachments;
	}
	public function setAttachment(Vendor $attachments): void
	{
		$this->attachments = $attachments;
	}
}
