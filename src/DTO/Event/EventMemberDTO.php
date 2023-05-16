<?php

namespace App\DTO\Event;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;


#[ApiResource(mercure: true)]
final class EventMemberDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    private int $eventIdDTO;
    // TODO: не работает ассоциация

//    private ArrayCollection $eventMemberIdDTO;

    private bool|string $eventMemberStatus = '0';

    private bool|string $eventPermission = '3';

    private ?int $eventInvitedBy = null;
    /**
     * @var bool|null
     *                TODO: сомнительное свойство
     */
    private ?bool $eventApproval = false;
}
