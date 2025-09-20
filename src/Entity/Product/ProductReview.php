<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\ReviewTrait;
use App\Repository\Review\ProductReviewRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'product_review')]
#[ORM\Index(columns: ['slug'], name: 'product_review_idx')]
#[ORM\Entity(repositoryClass: ProductReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductReview
{
    use BaseTrait;
    use ObjectTrait;
    use ReviewTrait;

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
    # ManyToOne
    public function getProductReviewProduct(): Product
    {
        return $this->productReviewProduct;
    }
    public function setProductReviewProduct(Product $product): void
    {
        $this->productReviewProduct = $product;
    }

}
