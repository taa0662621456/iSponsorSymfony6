<?php

namespace App\DTO\Project;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProjectPlatformRewardDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Project $projectId;

    private string $commissionStartTime;

    private string $commissionEndTime;

    public function getProjectId(): Project
    {
        return $this->projectId;
    }

    public function setProjectId($projectId): void
    {
        $this->projectId = $projectId;
    }

    public function getCommissionStartTime(): string
    {
        return $this->commissionStartTime;
    }

    public function setCommissionStartTime(string $commissionStartTime): void
    {
        $this->commissionStartTime = $commissionStartTime;
    }

    public function getCommissionEndTime(): string
    {
        return $this->commissionEndTime;
    }

    public function setCommissionEndTime(string $commissionEndTime): void
    {
        $this->commissionEndTime = $commissionEndTime;
    }
}
