<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductReviewInterface;

#[ORM\Entity]
final class ProductReview extends ObjectSuperEntity implements ObjectInterface, ProductReviewInterface
{
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'product_id', nullable: true)]
    private ?string $productId = null;

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productReviewProduct;

    // ManyToOne
    public function getProductReviewProduct(): Product
    {
        return $this->productReviewProduct;
    }

    public function setProductReviewProduct(Product $product): void
    {
        $this->productReviewProduct = $product;
    }
}
