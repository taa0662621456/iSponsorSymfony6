<?php

namespace App\Service\Review;

use Doctrine\Persistence\ObjectManager;

class ReviewRatingUpdater implements ReviewableRatingUpdaterInterface
{
    public function __construct(
        private readonly ReviewableRatingCalculatorInterface $averageRatingCalculator,
        private readonly ObjectManager                       $reviewSubjectManager,
    ) {
    }

    public function update(ReviewableInterface $reviewSubject): void
    {
        $this->modifyReviewSubjectAverageRating($reviewSubject);
    }

    public function updateFromReview(ReviewInterface $review): void
    {
        $this->modifyReviewSubjectAverageRating($review->getReviewSubject());
    }

    private function modifyReviewSubjectAverageRating(ReviewableInterface $reviewSubject): void
    {
        $averageRating = $this->averageRatingCalculator->calculate($reviewSubject);

        $reviewSubject->setAverageRating($averageRating);

        $this->reviewSubjectManager->flush();
    }
}
