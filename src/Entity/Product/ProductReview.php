<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Entity\ObjectReviewTrait;
use App\Interface\Product\ProductReviewInterface;
use App\Repository\Review\ProductReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_review')]
#[ORM\Index(columns: ['slug'], name: 'product_review_idx')]
#[ORM\Entity(repositoryClass: ProductReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
])]
class ProductReview implements ProductReviewInterface
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use ObjectReviewTrait;

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
