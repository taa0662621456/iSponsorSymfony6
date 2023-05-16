<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectPlatformRewardInterface;

#[ORM\Entity]
final class ProjectPlatformReward extends ObjectSuperEntity implements ObjectInterface, ProjectPlatformRewardInterface
{
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectPlatformReward')]
    private Project $projectId;

    #[ORM\Column(name: 'commission_start_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $commissionStartTime;

    #[ORM\Column(name: 'commission_end_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
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
