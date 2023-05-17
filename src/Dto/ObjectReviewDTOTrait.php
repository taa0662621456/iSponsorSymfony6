<?php

namespace App\Dto;

trait ObjectReviewDTOTrait
{
    private ?string $review = null;

    private ?string $reviewLang = null;

    private ?string $reviewType = null;

    private int $favourite = 0;

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): void
    {
        $this->review = $review;
    }

    public function getReviewLang(): ?string
    {
        return $this->reviewLang;
    }

    public function setReviewLang(?string $reviewLang): void
    {
        $this->reviewLang = $reviewLang;
    }

    public function getReviewType(): ?string
    {
        return $this->reviewType;
    }

    public function setReviewType(?string $reviewType): void
    {
        $this->reviewType = $reviewType;
    }

    public function getFavourite(): int
    {
        return $this->favourite;
    }

    public function setFavourites(int $favourite): void
    {
        $this->favourite = $favourite;
    }
}
