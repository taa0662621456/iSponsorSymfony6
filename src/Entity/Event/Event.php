<?php

namespace App\Entity\Event;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'events')]
#[ORM\Index(columns: ['start_date', 'end_date'], name: 'event_idx_period')]
#[ORM\Index(columns: ['type'], name: 'event_idx_type')]
#[ORM\Index(columns: ['published'], name: 'event_idx_published')]
#[ORM\Index(columns: ['cat_id'], name: 'event_idx_cat_id')]
#[ORM\Entity]
class Event
{
    use BaseTrait;

    #[ORM\Column(name: 'parent', type: 'integer', nullable: false, options: ['comment' => 'parent for recurring event'])]
    private int $parent;

    #[ORM\Column(name: 'cat_id', type: 'integer', nullable: false, options: ['unsigned' => true])]
    private int $catId;

    #[ORM\Column(name: 'content_id', type: 'integer', nullable: true, options: ['unsigned' => true, 'comment' => '0 - if type == profile, else it hold the group id'])]
    private int|null $contentId = 0;

    #[ORM\Column(name: 'type', type: 'string', length: 255, nullable: false, options: ['default' => 'profile', 'comment' => 'profile, group'])]
    private string $type = 'profile';

    #[ORM\Column(name: 'location', type: 'text', length: 65535, nullable: false)]
    private string $location;

    #[ORM\Column(name: 'unlisted', type: 'boolean', nullable: false)]
    private bool $unlisted;

    #[ORM\Column(name: 'start_date', type: 'string', nullable: false)]
    private string $startDate;

    #[ORM\Column(name: 'end_date', type: 'string', nullable: false)]
    private string $endDate;

    #[ORM\Column(name: 'permission', type: 'boolean', nullable: false, options: ['comment' => '0 - Open (Anyone can mark attendance), 1 - Private (Only invited can mark attendence)'])]
    private int|bool $permission = 0;

    #[ORM\Column(name: 'cover', type: 'text', length: 65535, nullable: false)]
    private string $cover;

    #[ORM\Column(name: 'invited_count', type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $invitedCount = 0;

    #[ORM\Column(name: 'confirmed_count', type: 'integer', nullable: true, options: ['unsigned' => true, 'comment' => 'treat this as member count as well'])]
    private ?int $confirmedCount = 0;

    #[ORM\Column(name: 'declined_count', type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $declinedCount = 0;

    #[ORM\Column(name: 'maybe_count', type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $maybeCount = 0;

    #[ORM\Column(name: 'wall_count', type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $wallCount = 0;

    #[ORM\Column(name: 'ticket', type: 'integer', nullable: true, options: ['unsigned' => true, 'comment' => 'Represent how many guest can be joined or invited.'])]
    private ?int $ticket = 0;

    #[ORM\Column(name: 'allow_invite', type: 'boolean', nullable: true, options: ['default' => 1, 'comment' => '0 - guest member cannot invite thier friends to join. 1 - yes, guest member can invite any of thier friends to join.'])]
    private ?bool $allowInvite = true;

    #[ORM\Column(name: 'hits', type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $hits = 0;

    #[ORM\Column(name: 'latitude', type: 'float', precision: 10, scale: 6, nullable: false, options: ['default' => '255.000000'])]
    private float|string $latitude = '255.000000';

    #[ORM\Column(name: 'longitude', type: 'integer', precision: 10, scale: 6, nullable: false, options: ['default' => '255.000000'])]
    private int $longitude = 255;

    #[ORM\Column(name: 'offset', type: 'string', length: 5, nullable: true)]
    private ?string $offset = null;

    #[ORM\Column(name: 'all_day', type: 'boolean', nullable: false)]
    private int|bool $allDay = 0;
    #[ORM\Column(name: 'repeat', type: 'string', length: 50, nullable: true, options: ['comment' => 'null,daily,weekly,monthly'])]
    private ?string $repeat = null;

    #[ORM\Column(name: 'repeat_end', type: 'string', nullable: false)]
    private string $repeatEnd;
}
