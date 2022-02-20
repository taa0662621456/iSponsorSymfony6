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
    public function getProjectCategory(): ArrayCollection|Project;

    public function addProjectCategory(Project $projectCategory): void;

    public function getProjectType(): ?string;

    public function setProjectType(string $projectType): void;

    public function addProjectTag(ProjectTag $tags): void;

    public function removeProjectTag(ProjectTag $tag): void;

    public function getProjectTags(): ArrayCollection;

    public function addProjectAttachment(ProjectAttachment $attachments): void;

    public function removeProjectAttachment(ProjectAttachment $attachment): void;

    public function getProjectAttachments(): ArrayCollection;

    public function addProjectProducts(Product $products): void;

    public function removeProjectProducts(Product $product): void;


    public function getProjectProducts(): ArrayCollection;

    public function addProjectPlatformReward(ProjectPlatformReward $rewards): void;

    public function removeProjectPlatformReward(ProjectPlatformReward $reward): void;

    public function getProjectPlatformReward(): ArrayCollection;

    public function getProjectEnGb(): ArrayCollection|ProductEnGb;

    /**
     * @param $projectEnGb
     */
    public function setProjectEnGb($projectEnGb): void;

    public function getProjectFavourites(): int;

    public function setProjectFavourites(int $projectFavourites): void;

    public function getProjectFeatured(): Featured;

    /**
     * @param $projectFeatured
     */
    public function setProjectFeatured($projectFeatured): void;

}
