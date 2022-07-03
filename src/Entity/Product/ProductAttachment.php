<?php


namespace App\Entity\Product;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Repository\Product\ProductAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'products_attachments')]
#[ORM\Index(columns: ['slug'], name: 'product_attachment_idx')]
#[ORM\Entity(repositoryClass: ProductAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductAttachment
{
	use BaseTrait;
	use AttachmentTrait;
	#[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachments')]
	#[ORM\JoinColumn(name: 'productAttachments_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private Product $productAttachments;

    /**
     * @return Product
     */
	public function getProductAttachments(): Product
    {
		return $this->productAttachments;
	}
	public function setProductAttachments(Product $productAttachments): void
	{
		$this->productAttachments = $productAttachments;
	}
}
