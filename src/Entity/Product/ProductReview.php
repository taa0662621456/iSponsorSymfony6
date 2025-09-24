<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\ReviewFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\ReviewTrait;
use App\Repository\Review\ProductReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;


#[ORM\Table(name: 'product_review')]
#[ORM\Index(columns: ['slug'], name: 'product_review_idx')]
#[ORM\Entity(repositoryClass: ProductReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class ProductReview
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    use ReviewTrait;
    # API Filters
    use TimestampFilterTrait;
    use ReviewFilterTrait;
    use RelationFilterTrait;

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