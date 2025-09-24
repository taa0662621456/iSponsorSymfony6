<?php

namespace App\EntityInterface\Project;

use App\EntityInterface\Category\CategoryInterface;

interface ProjectInterface
{
    public function getProjectCategory(): CategoryInterface;
    public function setProjectCategory(?CategoryInterface $projectCategory): void;
}