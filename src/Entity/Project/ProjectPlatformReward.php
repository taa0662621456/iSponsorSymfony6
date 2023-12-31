<?php

namespace App\Entity\Project;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectPlatformRewardInterface;

#[ORM\Entity]
class ProjectPlatformReward extends RootEntity implements ObjectInterface, ProjectPlatformRewardInterface
{
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectPlatformReward')]
    private Project $projectId;

    #[ORM\Column(name: 'commission_start_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $commissionStartTime;

    #[ORM\Column(name: 'commission_end_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $commissionEndTime;

    public function __construct()
    {
        parent::__construct();
        $this->commissionStartTime = date('Y-m-d H:i:s');
        $this->commissionEndTime = date('Y-m-d H:i:s');
    }
}
