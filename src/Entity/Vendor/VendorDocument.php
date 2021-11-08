<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_attachments", indexes={
 * @ORM\Index(name="vendor_attachment_idx", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="document:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="document:item"}}},
 *     order={"createdAt"="DESC"},
 *     paginationEnabled=false
 *     )
 * @ApiFilter(SearchFilter::class, properties={"vendor": "exact"})
 */
class VendorDocument
{
	use BaseTrait;
	use AttachmentTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendor", inversedBy="vendorDocumentAttachments")
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
	 * @param Vendor $attachments
	 */
	public function setAttachment(Vendor $attachments): void
	{
		$this->attachments = $attachments;
	}
}
