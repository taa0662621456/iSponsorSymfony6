<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_attachments", indexes={
 * @ORM\Index(name="vendor_attachment_idx", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsDocumentAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorDocumentAttachments")
	 * @ORM\JoinColumn(name="attachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private $attachments;

	/**
	 * @return mixed
	 */
	public function getAttachments()
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
