<?php

namespace App\Service\Review;

class ReviewRatingCalculator
{
    public const STATUS_NEW = 'new';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_REJECTED = 'rejected';

    public function calculate($reviewable): float
    {
        $sum = 0;
        $reviewsNumber = 0;
        $reviews = $reviewable->getReviews();

        foreach ($reviews as $review) {
            if (self::STATUS_ACCEPTED === $review->getStatus()) {
                $reviewsNumber++;

                $sum += $review->getRating();
            }
        }

        return 0 !== $reviewsNumber ? $sum / $reviewsNumber : 0;
    }
}
