<?php

namespace App\Interface\Project;

interface ProjectReviewInterface
{
    public function getProjectReviewId(): ?string;

    public function setProjectReviewId(?string $projectReviewId): void;

    public function getProjectReviewUuid(): ?string;

    public function setProjectReviewUuid(?string $projectReviewUuid): void;

    public function getProjectReviewSlug(): ?string;

    public function setProjectReviewSlug(?string $projectReviewSlug): void;

}
