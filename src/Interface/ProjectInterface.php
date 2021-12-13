<?php

namespace App\Interface;

use App\Entity\Featured\Featured;
use App\Entity\Product\Product;
use App\Entity\Product\ProductEnGb;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Project\ProjectPlatformReward;
use App\Entity\Project\ProjectTag;
use Doctrine\Common\Collections\ArrayCollection;

interface ProjectInterface
{
    /**
     * @return Project
     */
    public function getProjectCategory(): Project;

    /**
     * @param Project $projectCategory
     */
    public function setProjectCategory(Project $projectCategory): void;

    /**
     * @return string|null
     */
    public function getProjectType(): ?string;

    /**
     * @param string $projectType
     */
    public function setProjectType(string $projectType): void;

    /**
     * @param ProjectTag $tags
     */
    public function addProjectTag(ProjectTag $tags): void;

    /**
     * @param ProjectTag $tag
     */
    public function removeProjectTag(ProjectTag $tag): void;

    /**
     * @return ArrayCollection
     */
    public function getProjectTags(): ArrayCollection;

    /**
     * @param ProjectAttachment $attachments
     */
    public function addProjectAttachment(ProjectAttachment $attachments): void;

    /**
     * @param ProjectAttachment $attachment
     */
    public function removeProjectAttachment(ProjectAttachment $attachment): void;

    /**
     * @return ArrayCollection
     */
    public function getProjectAttachments(): ArrayCollection;

    /**
     * @param Product $products
     */
    public function addProjectProducts(Product $products): void;

    /**
     * @param Product $product
     */
    public function removeProjectProducts(Product $product): void;


    /**
     * @return ArrayCollection
     */
    public function getProjectProducts(): ArrayCollection;

    /**
     * @param ProjectPlatformReward $rewards
     */
    public function addProjectPlatformReward(ProjectPlatformReward $rewards): void;

    /**
     * @param ProjectPlatformReward $reward
     */
    public function removeProjectPlatformReward(ProjectPlatformReward $reward): void;

    /**
     * @return ArrayCollection
     */
    public function getProjectPlatformReward(): ArrayCollection;

    /**
     * @return ProductEnGb
     */
    public function getProjectEnGb(): ProductEnGb;

    /**
     * @param $projectEnGb
     */
    public function setProjectEnGb($projectEnGb): void;

    /**
     * @return int
     */
    public function getProjectFavourites(): int;

    /**
     * @param int $projectFavourites
     */
    public function setProjectFavourites(int $projectFavourites): void;

    /**
     * @return Featured
     */
    public function getProjectFeatured(): Featured;

    /**
     * @param $projectFeatured
     */
    public function setProjectFeatured($projectFeatured): void;

}
