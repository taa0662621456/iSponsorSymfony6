<?php

namespace App\Interface;

interface ReviewProjectInterface
{
    /**
     * @return string|null
     */
    public function getProjectId(): ?string;

    /**
     * @param string|null $projectId
     */
    public function setProjectId(?string $projectId): void;

    /**
     * @return string|null
     */
    public function getProjectUuid(): ?string;

    /**
     * @param string|null $projectUuid
     */
    public function setProjectUuid(?string $projectUuid): void;

    /**
     * @return string|null
     */
    public function getProjectSlug(): ?string;

    /**
     * @param string|null $projectSlug
     */
    public function setProjectSlug(?string $projectSlug): void;

}
