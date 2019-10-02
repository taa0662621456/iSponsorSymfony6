<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_attachments", indexes={
 * @ORM\Index(name="vendor_attachment_slug", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsDocAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorsDocsAttachments")
	 * @ORM\JoinColumn(name="vendorsDocsAttachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private $vendorsDocsAttachments;

	/**
	 * @return mixed
	 */
	public function getVendorsDocsAttachments()
	{
		return $this->vendorsDocsAttachments;
	}

	/**
	 * @param mixed $vendorsDocsAttachments
	 */
	public function setVendorsDocsAttachments($vendorsDocsAttachments): void
	{
		$this->vendorsDocsAttachments = $vendorsDocsAttachments;
	}
}
