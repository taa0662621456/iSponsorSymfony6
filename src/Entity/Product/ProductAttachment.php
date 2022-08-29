<?php


namespace App\Entity\Product;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Product\ProductAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_attachment')]
#[ORM\Index(columns: ['slug'], name: 'product_attachment_idx')]
#[ORM\Entity(repositoryClass: ProductAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductAttachment
{
	use BaseTrait;
    use ObjectTrait;
	use AttachmentTrait;
	#[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
	#[ORM\JoinColumn(onDelete: 'CASCADE')]
	private Product $productAttachment;

    /**
     * @return Product
     */
	public function getProductAttachment(): Product
    {
		return $this->productAttachment;
	}
	public function setProductAttachment(Product $productAttachment): void
	{
		$this->productAttachment = $productAttachment;
	}
}
