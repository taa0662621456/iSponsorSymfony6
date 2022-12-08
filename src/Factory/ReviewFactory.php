<?php

namespace App\Factory;

final class ReviewFactory
{
    public function __construct(private $factory)
    {
    }

    public function createNew()
    {
        return $this->factory->createNew();
    }

    public function createForSubject($subject)
    {
        $review = $this->factory->createNew();
        $review->setReviewSubject($subject);

        return $review;
    }

    public function createForSubjectWithReviewer($subject, $reviewer)
    {
        $review = $this->createForSubject($subject);
        $review->setAuthor($reviewer);

        return $review;
    }
}
