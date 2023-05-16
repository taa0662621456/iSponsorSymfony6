<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ObjectReviewTrait
{
    #[ORM\Column(name: 'review', nullable: true)]
    private ?string $review = null;

    #[ORM\Column(name: 'review_lang', nullable: true)]
    private ?string $reviewLang = null;

    #[ORM\Column(name: 'review_type', nullable: true)]
    private ?string $reviewType = null;

    #[ORM\Column(name: 'favorite', type: 'integer', nullable: false, options: ['default' => 0])]
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
