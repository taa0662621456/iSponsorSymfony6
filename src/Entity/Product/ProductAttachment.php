<?php

namespace App\Entity\Product;

use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductAttachmentInterface;

#[ORM\Entity]
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
