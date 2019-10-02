<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_medias", indexes={
 * @ORM\Index(name="vendor_media_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsMediaAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorsMediasAttachments")
	 * @ORM\JoinColumn(name="vendorMediaAttachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private $vendorMediaAttachments;

	/**
	 * @return mixed
	 */
	public function getVendorMediaAttachments()
	{
		return $this->vendorMediaAttachments;
	}

	/**
	 * @param mixed $vendorMediaAttachments
	 */
	public function setVendorMediaAttachments($vendorMediaAttachments): void
	{
		$this->vendorMediaAttachments = $vendorMediaAttachments;
	}
}
