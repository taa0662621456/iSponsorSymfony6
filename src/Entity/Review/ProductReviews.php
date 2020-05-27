<?php
declare(strict_types=1);

namespace App\Entity\Review;

use App\Entity\AkismetTrait;
use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="product_reviews", indexes={
 * @ORM\Index(name="product_reviews_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Review\ProductReviewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductReviews
{
    use BaseTrait;
    use ReviewTrait;
    use AkismetTrait;

    public const NUM_ROWS = 10;

    /**
     * @var string|null
     * @ORM\Column(name="product_id", type="string", nullable=true)
     */
    private $productId;

    /**
     * @var string|null
     * @ORM\Column(name="product_uuid", type="string", nullable=true)
     */
    private $productUuid;

    /**
     * @var string|null
     * @ORM\Column(name="product_slug", type="string", nullable=true)
     */
    private $productSlug;

    /**
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->productId;
    }

    /**
     * @param string|null $productId
     */
    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string|null
     */
    public function getProductUuid(): ?string
    {
        return $this->productUuid;
    }

    /**
     * @param string|null $productUuid
     */
    public function setProductUuid(?string $productUuid): void
    {
        $this->productUuid = $productUuid;
    }

    /**
     * @return string|null
     */
    public function getProductSlug(): ?string
    {
        return $this->productSlug;
    }

    /**
     * @param string|null $productSlug
     */
    public function setProductSlug(?string $productSlug): void
    {
        $this->productSlug = $productSlug;
    }


}
