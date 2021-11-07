<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_medias", indexes={
 * @ORM\Index(name="vendor_media_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorsMediaAttachmentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsMediaAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors",
     *      inversedBy="vendorMediaAttachments")
	 * @ORM\JoinColumn(name="attachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private mixed $attachments;

	/**
	 * @return mixed
	 */
	public function getAttachments(): mixed
    {
		return $this->attachments;
	}

	/**
	 * @param Vendors $attachments
	 */
	public function setAttachment(Vendors $attachments): void
	{
		$this->attachments = $attachments;
	}
}
