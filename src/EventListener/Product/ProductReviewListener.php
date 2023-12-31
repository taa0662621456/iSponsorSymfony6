<?php

namespace App\EventListener\Product;

use App\EntityInterface\Product\ProductReviewInterface;
use App\EntityInterface\Product\ProductReviewRatingInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs as BaseLifecycleEventArgs;

final class ProductReviewListener
{
    public function __construct(private readonly ProductReviewRatingInterface $productReviewRating)
    {
    }

    public function postPersist(BaseLifecycleEventArgs $args): void
    {
        $this->recalculateProductReviewRating($args);
    }

    public function postUpdate(BaseLifecycleEventArgs $args): void
    {
        $this->recalculateProductReviewRating($args);
    }

    public function postRemove(BaseLifecycleEventArgs $args): void
    {
        $this->recalculateProductReviewRating($args);
    }

    public function recalculateProductReviewRating(BaseLifecycleEventArgs $args): void
    {
        $subject = $args->getObject();

        if (!$subject instanceof ProductReviewInterface) {
            return;
        }

        $this->productReviewRating->update($subject->getReview());
    }
}
