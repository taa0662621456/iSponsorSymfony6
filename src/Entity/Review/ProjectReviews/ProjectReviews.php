<?php
declare(strict_types=1);

namespace App\Entity\Review\ProjectReviews;

use App\Entity\BaseTrait;

/**
 * @ORM\Table(name="projectReviews", indexes={
 * @ORM\Index(name="project_idx", columns={"slug"})})
 * UniqueEntity("slug"),
 *        errorPath="slug",
 *        message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Review\ProjectReviewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectReviews
{
    use BaseTrait;
    public const NUM_ROWS = 10;
    /**
     * @var string|null
     * @ORM\Column(name="review_lang", type="string", nullable=true)
     */
    private $reviewLang;

    /**
     * @var string|null
     * @ORM\Column(name="review_type", type="string", nullable=true)
     */
    private $reviewType;

    /**
     * @var int
     *
     * @ORM\Column(name="published", type="integer", nullable=false, options={"default" : 0})
     */
    private $published = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="favorite", type="integer", nullable=false, options={"default" : 0})
     */
    private $favourite = 0;

    /**
     * @return string|null
     */
    public function getReviewLang(): ?string
    {
        return $this->reviewLang;
    }

    /**
     * @param string|null $reviewLang
     */
    public function setReviewLang(?string $reviewLang): void
    {
        $this->reviewLang = $reviewLang;
    }

    /**
     * @return string|null
     */
    public function getReviewType(): ?string
    {
        return $this->reviewType;
    }

    /**
     * @param string|null $reviewType
     */
    public function setReviewType(?string $reviewType): void
    {
        $this->reviewType = $reviewType;
    }

    /**
     * @return int
     */
    public function getPublished(): int
    {
        return $this->published;
    }

    /**
     * @param int $published
     */
    public function setPublished(int $published): void
    {
        $this->published = $published;
    }

    /**
     * @return int
     */
    public function getFavourite(): int
    {
        return $this->favourite;
    }

    /**
     * @param int $favourite
     */
    public function setFavourites(int $favourite): void
    {
        $this->favourite = $favourite;
    }
}