<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products_attachments", indexes={
 * @ORM\Index(name="product_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductAttachmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductAttachment
{
	use BaseTrait;
	use AttachmentTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product\Product", inversedBy="productAttachments")
	 * @ORM\JoinColumn(name="productAttachments_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $productAttachments;

	/**
	 * @return mixed
	 */
	public function getProductAttachments()
	{
		return $this->productAttachments;
	}

	/**
	 * @param Product $productAttachments
	 */
	public function setProductAttachments(Product $productAttachments): void
	{
		$this->productAttachments = $productAttachments;
	}


}
