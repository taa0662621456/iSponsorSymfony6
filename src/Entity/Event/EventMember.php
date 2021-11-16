<?php

namespace AppEntity;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EventsMembers
 *
 * @ORM\Table(name="event_members", indexes={
 *     @ORM\Index(name="idx_permission", columns={"eventid", "permission"}),
 *     @ORM\Index(name="idx_member_event", columns={"event_id", "member_id"}),
 *     @ORM\Index(name="idx_eventid", columns={"event_id"}),
 *     @ORM\Index(name="idx_invitedby", columns={"invited_by"})})
 * @ORM\Entity
 */
class EventMember
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $eventId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vendor\Vendor",
     *      mappedBy="eventMemberId")
     */
    private ArrayCollection $eventMemberId;

    /**
     * @var bool
     *
     * @ORM\Column(name="event_member_status", type="boolean", nullable=false, options={"comment"="[Join / Invite]: 0 - [pending approval/pending invite], 1 - [approved/confirmed], 2 - [rejected/declined], 3 - [maybe/maybe], 4 - [blocked/blocked]"})
     */
    private $eventMemberStatus = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="event_permission", type="boolean", nullable=false, options={"default"="3","comment"="1 - creator, 2 - admin, 3 - member"})
     */
    private $eventPermission = '3';

    /**
     * @var int|null
     *
     * @ORM\Column(name="event_invited_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $eventInvitedBy = '0';

    /**
     * @var bool|null
     * TODO: сомнительное свойсто
     * @ORM\Column(name="event_approval", type="boolean", nullable=true, options={"comment"="0 - no approval required, 1 - required admin approval"})
     */
    private $eventApproval = '0';

}
