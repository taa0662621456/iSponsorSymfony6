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


use App\Entity\BaseTrait;
use Symfony\Component\Validator\Constraints\DateTime;

class Commission
{
    use BaseTrait;

    /** //TODO: свойство может быть отношением (подумать)
     * @var int
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false, options={"default" : 0})
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


}
