<?php

namespace App\EntityInterface\Category;

use App\EntityInterface\Project\ProjectInterface;
use Doctrine\Common\Collections\Collection;

interface CategoryInterface
{
    public function getCategoryProject(): Collection;
    //public function addCategoryProject(ProjectInterface $project): void;
    //public function removeCategoryProject(ProjectInterface $project): void;
}