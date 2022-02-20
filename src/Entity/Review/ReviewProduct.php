<?php


namespace App\Entity\Review;

use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;
use App\Repository\Review\ProductReviewRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'product_reviews')]
#[ORM\Index(columns: ['slug'], name: 'product_reviews_idx')]
#[ORM\Entity(repositoryClass: ProductReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ReviewProduct
{
    use BaseTrait;
    use ReviewTrait;
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'product_id', type: 'string', nullable: true)]
    private ?string $productId = null;

    #[ORM\Column(name: 'product_uuid', type: 'string', nullable: true)]
    private ?string $productUuid = null;

    #[ORM\Column(name: 'product_slug', type: 'string', nullable: true)]
    private ?string $productSlug = null;
    public function getProductId(): ?string
    {
        return $this->productId;
    }
    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }
    public function getProductUuid(): ?string
    {
        return $this->productUuid;
    }
    public function setProductUuid(?string $productUuid): void
    {
        $this->productUuid = $productUuid;
    }
    public function getProductSlug(): ?string
    {
        return $this->productSlug;
    }
    public function setProductSlug(?string $productSlug): void
    {
        $this->productSlug = $productSlug;
    }
}
