<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'rewards')]
#[ORM\Index(columns: ['slug'], name: 'commission_idx')]
#[ORM\Entity(repositoryClass: \App\Repository\Project\ProjectPlatformRewardRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectPlatformReward
{
    use BaseTrait;
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectPlatformReward')]
    #[ORM\JoinTable(name: 'project')]
    private Project $projectId;

    #[ORM\Column(name: 'commission_start_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $commissionStartTime;

    #[ORM\Column(name: 'commission_end_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $commissionEndTime;

    /**
     * @return Project
     */
    public function getProjectId()
    {
        return $this->projectId;
    }
    /**
     * @param $projectId
     */
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
