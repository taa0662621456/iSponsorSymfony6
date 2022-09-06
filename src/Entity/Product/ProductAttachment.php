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
	private Product $productAttachmentProduct;

    # ManyToOne
	public function getProductAttachmentProduct(): Product
    {
		return $this->productAttachmentProduct;
	}
    public function setProductAttachmentProduct(Product $product): void
    {
            $this->productAttachmentProduct = $product;
    }

}
