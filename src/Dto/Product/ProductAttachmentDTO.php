<?php

namespace App\Dto\Product;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;


final class ProductAttachmentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Product $productAttachmentProductDTO;

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
