<?php

namespace App\Factory;

final class ReviewFactory
{
    public function __construct(private $factory)
    {
    }

    public function create()
    {
        return $this->factory->create();
    }

    public function createForSubject($subject)
    {
        $review = $this->factory->create();
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