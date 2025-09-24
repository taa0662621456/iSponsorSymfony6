<?php

namespace App\Service;

class ReviewAverageRatingCalculator
{
    const STATUS_ACCEPTED = 'accepted';
    public function calculate($reviewable): float
    {
        $sum = 0;
        $reviewNumber = 0;
        $reviews = $reviewable->getReviews();

        foreach ($reviews as $review) {
            if (self::STATUS_ACCEPTED === $review->getStatus()) {
                ++$reviewNumber;

                $sum += $review->getRating();
            }
        }

        return 0 !== $reviewNumber ? $sum / $reviewNumber : 0;
    }
}