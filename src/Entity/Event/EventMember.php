<?php

namespace App\Entity\Event;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\EventFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'event_member')]
#[ORM\Index(columns: ['event_id', 'event_permission'], name: 'idx_permission')]
#[ORM\Index(columns: ['event_id'], name: 'idx_event_id')]
#[ORM\Index(columns: ['event_invited_by'], name: 'idx_invite_by')]
#[ORM\Entity]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class EventMember
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use EventFilterTrait;
    use TimestampFilterTrait;
    use RelationFilterTrait;

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
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }
}
