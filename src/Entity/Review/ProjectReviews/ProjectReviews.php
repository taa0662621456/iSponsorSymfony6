<?php
declare(strict_types=1);

namespace App\Entity\Review\ProjectReviews;

use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;

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
    use ReviewTrait;
    public const NUM_ROWS = 10;
}