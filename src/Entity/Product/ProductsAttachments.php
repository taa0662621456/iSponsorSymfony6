<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products_attachments", indexes={
 * @ORM\Index(name="product_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductsAttachmentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductsAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product\Products", inversedBy="productAttachments")
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
	 * @param Products $productAttachments
	 */
	public function setProductAttachments(Products $productAttachments): void
	{
		$this->productAttachments = $productAttachments;
	}


}
