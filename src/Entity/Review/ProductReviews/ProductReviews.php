<?php
declare(strict_types=1);

namespace App\Entity\Review\ProductReviews;

use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;

/**
 * @ORM\Table(name="productReviews", indexes={
 * @ORM\Index(name="product_idx", columns={"slug"})})
 * UniqueEntity("slug"),
 *        errorPath="slug",
 *        message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Review\ProductReviewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductReviews
{
    use BaseTrait;
    use ReviewTrait;
    public const NUM_ROWS = 10;
}