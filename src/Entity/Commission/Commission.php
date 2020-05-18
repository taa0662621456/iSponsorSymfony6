<?php
/**
 * каждый проект имеет комиссию площадки
 * комиссия начинает действие в момент ее создания (например, в момент добавления проекта)
 * комиссия может быть создана отдельно и иметь дату старта действия и окончания действия
 * комиссий может быть несколько (могут быть запланированы)
 * slug строки комиссии необходимо переодределить, чтобы таков не был в данной табличке уникальным, например
 * добавить префикс - порядковых номер комессии
 * при удалении проекта удаляются комиссии, соответственно необходимо отношение проектов к коммиссиям
 *
 */

namespace App\Entity\Commission;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\BaseTrait;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Table(name="commission", indexes={
 * @ORM\Index(name="commission_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Commission\CommissionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commission
{
    use BaseTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project\Projects", inversedBy="projectCommissions")
     * @ORM\JoinTable(name="project")
     */
    private $projectId;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="commission_start_time", type="datetime", nullable=false,
     *                                            options={"default":"CURRENT_TIMESTAMP"})
     */
    private $commissionStartTime;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="commission_end_time", type="datetime", nullable=false,
     *                                            options={"default":"CURRENT_TIMESTAMP"})
     */
    private $commissionEndTime;


    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId): void
    {
        $this->projectId = $projectId;
    }


    /**
     * @return DateTime
     */
    public function getCommissionStartTime(): DateTime
    {
        return $this->commissionStartTime;
    }

    /**
     * @param DateTime $commissionStartTime
     */
    public function setCommissionStartTime(DateTime $commissionStartTime): void
    {
        $this->commissionStartTime = $commissionStartTime;
    }

    /**
     * @return DateTime
     */
    public function getCommissionEndTime(): DateTime
    {
        return $this->commissionEndTime;
    }

    /**
     * @param DateTime $commissionEndTime
     */
    public function setCommissionEndTime(DateTime $commissionEndTime): void
    {
        $this->commissionEndTime = $commissionEndTime;
    }


}
