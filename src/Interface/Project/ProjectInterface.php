<?php

namespace App\Interface\Project;

use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use App\Entity\Product\Product;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Project\ProjectEnGb;
use App\Entity\Project\ProjectFavourite;
use App\Entity\Project\ProjectPlatformReward;
use App\Entity\Project\ProjectTag;
use App\Entity\Project\ProjectType;
use Doctrine\Common\Collections\Collection;

interface ProjectInterface
{
    // ManyToOne
    public function getProjectCategory(): Category;

    public function setProjectCategory(Category $projectCategory): void;

    // ManyToOne
    public function getProjectType(): ProjectType;

    public function setProjectType(ProjectType $projectType): void;

    // ManyToMany
    public function getProjectTag(): Collection;

    public function addProjectTag(ProjectTag $projectTag): self;

    public function removeProjectTag(ProjectTag $projectTag): self;

    // OneToMany
    public function getProjectAttachment(): Collection;

    public function addProjectAttachment(ProjectAttachment $projectAttachment): self;

    public function removeProjectAttachment(ProjectAttachment $projectAttachment): self;

    // OneToMany
    public function getProjectProduct(): Collection;

    public function addProjectProduct(Product $product): self;

    public function removeProjectProduct(Product $product): self;

    // OneToMany
    public function getProjectPlatformReward(): Collection;

    public function addProjectPlatformReward(ProjectPlatformReward $projectPlatformReward): self;

    public function removeProjectPlatformReward(ProjectPlatformReward $projectPlatformReward): self;

    // OneToOne
    public function getProjectEnGb(): ProjectEnGb;

    public function setProjectEnGb(ProjectEnGb $projectEnGb): void;

    // ManyToMany
    public function getProjectFavourite(): Collection;

    public function addProjectFavorite(ProjectFavourite $projectFavourite): self;

    public function removeProjectFavourite(ProjectFavourite $projectFavourite): self;

    // OneToOne
    public function getProjectFeatured(): Featured;

    public function setProjectFeatured(Featured $projectFeatured): void;
}
