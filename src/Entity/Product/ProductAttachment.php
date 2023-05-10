<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Entity\AttachmentTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductAttachmentInterface;
use App\Repository\Product\ProductAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_attachment')]
#[ORM\Index(columns: ['slug'], name: 'product_attachment_idx')]
#[ORM\Entity(repositoryClass: ProductAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class ProductAttachment extends ObjectSuperEntity implements ObjectInterface, ProductAttachmentInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productAttachmentProduct;

    // ManyToOne
    public function getProductAttachmentProduct(): Product
    {
        return $this->productAttachmentProduct;
    }

    public function setProductAttachmentProduct(Product $product): void
    {
        $this->productAttachmentProduct = $product;
    }
}
