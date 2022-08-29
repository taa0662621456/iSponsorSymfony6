<?php

namespace App\Entity\Event;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Vendor\Vendor;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'event_member')]
#[ORM\Index(columns: ['event_id', 'event_permission'], name: 'idx_permission')]
#[ORM\Index(columns: ['event_id'], name: 'idx_event_id')]
#[ORM\Index(columns: ['event_invited_by'], name: 'idx_invite_by')]
#[ORM\Entity]
class EventMember
{
    use BaseTrait;
    use ObjectTrait;
    #[ORM\Column(name: 'event_id', type: 'integer', nullable: false, options: ['unsigned' => true])]
    private int $eventId;
// TODO: не работает ассоциация
//    #[ORM\OneToMany(mappedBy: 'event_member_id', targetEntity: Vendor::class)]
//    private ArrayCollection $eventMemberId;

    #[ORM\Column(name: 'event_member_status', type: 'boolean', nullable: false, options: ['comment' => '[Join / Invite]: 0 - [pending approval/pending invite], 1 - [approved/confirmed], 2 - [rejected/declined], 3 - [maybe/maybe], 4 - [blocked/blocked]'])]
    private bool|string $eventMemberStatus = '0';

    #[ORM\Column(name: 'event_permission', type: 'boolean', nullable: false, options: ['default' => 3, 'comment' => '1 - creator, 2 - admin, 3 - member'])]
    private bool|string $eventPermission = '3';

    #[ORM\Column(name: 'event_invited_by', options: ['unsigned' => true])]
    private ?int $eventInvitedBy = null;
    /**
     * @var bool|null
     * TODO: сомнительное свойство
     */
    #[ORM\Column(name: 'event_approval', type: 'boolean', options: ['comment' => '0 - no approval required, 1 - required admin approval'])]
    private ?bool $eventApproval = false;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
}
