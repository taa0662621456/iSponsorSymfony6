<?php

namespace App\DTO\Event;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(mercure: true)]
final class EventDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $parentDTO;

    private int $catIdDTO;

    private ?int $contentId = null;

    private string $type = 'profile';

    private string $locationDTO;

    private bool $unlistedDTO;

    private string $startDateDTO;

    private string $endDateDTO;

    private int|bool $permission = 0;

    private string $coverDTO;

    private ?int $invitedCount = null;

    private ?int $confirmedCount = null;

    private ?int $declinedCount = null;

    private ?int $maybeCount = null;

    private ?int $wallCount = null;

    private ?int $ticket = null;

    private ?bool $allowInvite = true;

    private ?int $hits = null;

    private float|string $latitude = '255.000000';

    private int $longitude = 255;

    private ?string $offset = null;

    private int|bool $allDay = 0;

    private ?string $repeat = null;

    private string $repeatEndDTO;
}
