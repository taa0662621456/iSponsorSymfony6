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
     * @var string
     *
     * @ORM\Column(name="commission_start_time", type="string", nullable=false,
     *                                            options={"default":"CURRENT_TIMESTAMP"})
     */
    private string $commissionStartTime;

    /**
     * @var string
     *
     * @ORM\Column(name="commission_end_time", type="string", nullable=false,
     *                                            options={"default":"CURRENT_TIMESTAMP"})
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
