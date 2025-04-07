<?php

namespace App\Entity\Event;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Event\EventMemberInterface;

#[ORM\Index(columns: ['event_id', 'event_permission'], name: 'idx_permission')]
#[ORM\Index(columns: ['event_id'], name: 'idx_event_id')]
#[ORM\Index(columns: ['event_invited_by'], name: 'idx_invite_by')]
#[ORM\Entity]
class EventMember extends RootEntity implements ObjectInterface, EventMemberInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'event_id', type: 'integer', nullable: false, options: ['unsigned' => true])]
    private int $eventId;

    #[ORM\Column(name: 'event_member_status', type: 'boolean', nullable: false, options: ['comment' => '[Join / Invite]: 0 - [pending approval/pending invite], 1 - [approved/confirmed], 2 - [rejected/declined], 3 - [maybe/maybe], 4 - [blocked/blocked]'])]
    private bool|string $eventMemberStatus = '0';

    #[ORM\Column(name: 'event_permission', type: 'boolean', nullable: false, options: ['default' => 3, 'comment' => '1 - creator, 2 - admin, 3 - member'])]
    private bool|string $eventPermission = '3';

    #[ORM\Column(name: 'event_invited_by', options: ['unsigned' => true])]
    private ?int $eventInvitedBy = null;

    /**
     * @var bool|null
     *                TODO: сомнительное свойство
     */
    #[ORM\Column(name: 'event_approval', type: 'boolean', options: ['comment' => '0 - no approval required, 1 - required admin approval'])]
    private ?bool $eventApproval = false;
}
