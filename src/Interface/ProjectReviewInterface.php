<?php

namespace App\Interface;

interface ProjectReviewInterface
{
    public function getProjectId(): ?string;

    public function setProjectId(?string $projectId): void;

    public function getProjectUuid(): ?string;

    public function setProjectUuid(?string $projectUuid): void;

    public function getProjectSlug(): ?string;

    public function setProjectSlug(?string $projectSlug): void;

}
