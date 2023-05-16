<?php

namespace App\DTO\Project;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(
    order: ['createdAt' => 'DESC'],
    paginationEnabled: true
)]

final class ProjectReviewDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public const NUM_ROWS = 10;

    private ?string $projectReviewId = null;

    public function getProjectReviewId(): ?string
    {
        return $this->projectReviewId;
    }

    public function setProjectReviewId(?string $projectReviewId): void
    {
        $this->projectReviewId = $projectReviewId;
    }

    private Project $projectReviewProjectDTO;

    // ManyToOne
    public function getProjectReviewProject(): Project
    {
        return $this->projectReviewProject;
    }

    public function setProjectReviewProject(Project $project): void
    {
        $this->projectReviewProject = $project;
    }

    public function getProjectReviewUuid(): ?string
    {
        // TODO: Implement getProjectReviewUuid() method.
        return '';
    }

    public function setProjectReviewUuid(?string $projectReviewUuid): void
    {
        // TODO: Implement setProjectReviewUuid() method.
    }

    public function getProjectReviewSlug(): ?string
    {
        // TODO: Implement getProjectReviewSlug() method.
        return '';
    }

    public function setProjectReviewSlug(?string $projectReviewSlug): void
    {
        // TODO: Implement setProjectReviewSlug() method.
    }
}
