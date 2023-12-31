<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductReviewInterface;

#[ORM\Entity]
class ProductReview extends RootEntity implements ObjectInterface, ProductReviewInterface
{
    public const NUM_ROWS = 10;

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'product_id', nullable: true)]
    private ?string $productId = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productReviewProduct;
}
