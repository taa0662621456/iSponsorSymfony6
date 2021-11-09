<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="rewards", indexes={
 * @ORM\Index(name="commission_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectPlatformRewardRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectPlatformReward
{
    use BaseTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project\Project", inversedBy="projectPlatformReward")
     * @ORM\JoinTable(name="project")
     */
    private $projectId;

    /**
     * @var string
     *
     * @ORM\Column(name="commission_start_time", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private string $commissionStartTime;

    /**
     * @var string
     *
     * @ORM\Column(name="commission_end_time", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private string $commissionEndTime;


    /**
     * @return mixed
     */
    public function getProjectId(): mixed
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId(mixed $projectId): void
    {
        $this->projectId = $projectId;
    }


    /**
     * @return string
     */
    public function getCommissionStartTime(): string
    {
        return $this->commissionStartTime;
    }

    /**
     * @param string $commissionStartTime
     */
    public function setCommissionStartTime(string $commissionStartTime): void
    {
        $this->commissionStartTime = $commissionStartTime;
    }

    /**
     * @return string
     */
    public function getCommissionEndTime(): string
    {
        return $this->commissionEndTime;
    }

    /**
     * @param string $commissionEndTime
     */
    public function setCommissionEndTime(string $commissionEndTime): void
    {
        $this->commissionEndTime = $commissionEndTime;
    }


}
