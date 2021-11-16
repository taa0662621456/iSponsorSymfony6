<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_medias", indexes={
 * @ORM\Index(name="vendor_media_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorMediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorMedia
{
	use BaseTrait;
	use AttachmentTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendor",
     *      inversedBy="vendorMediaAttachments")
	 * @ORM\JoinColumn(name="attachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private Vendor $attachments;

    /**
     * @return \App\Entity\Vendor\Vendor
     */
	public function getAttachments(): Vendor
    {
		return $this->attachments;
	}

	/**
	 * @param Vendor $attachments
	 */
	public function setAttachment(Vendor $attachments): void
	{
		$this->attachments = $attachments;
	}
}
