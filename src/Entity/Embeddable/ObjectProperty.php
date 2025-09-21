<?php

namespace App\Entity\Embeddable;

use App\Entity\Vendor\Vendor;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Embeddable]
class ObjectProperty
{
    #[ORM\Column(name: 'published', type: 'boolean')]
    private bool $published = true;

    #[ORM\Column(name: 'slug', type: 'string', length: 128, unique: true)]
    private string $slug;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'created_by', type: 'integer', nullable: true)]
    private ?int $createdBy = null;

    #[ORM\Column(name: 'modified_at', type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $modifiedAt = null;

    #[ORM\Column(name: 'modified_by', type: 'integer', nullable: true)]
    private ?int $modifiedBy = null;

    #[ORM\Column(name: 'locked_at', type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $lockedAt = null;

    #[ORM\Column(name: 'locked_by', type: 'integer', nullable: true)]
    private ?int $lockedBy = null;

    #[ORM\Column(name: 'current_state', type: 'string', length: 32, options: ['default' => 'submitted'])]
    private string $currentState = 'submitted';

    #[ORM\Version]
    #[ORM\Column(type: 'integer')]
    private int $version;

    #[ORM\Column(name: 'last_request_date', type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $lastRequestDate = null;

    public function __construct()
    {
        $this->slug = Uuid::uuid4()->toString();
        $this->createdAt = new DateTimeImmutable();
    }

    // === Helpers ===

    public function markCreated(int $userId): void
    {
        $this->createdAt = new DateTimeImmutable();
        $this->createdBy = $userId;
    }

    public function markModified(int $userId): void
    {
        $this->modifiedAt = new DateTimeImmutable();
        $this->modifiedBy = $userId;
    }

    public function markLocked(int $userId): void
    {
        $this->lockedAt = new DateTimeImmutable();
        $this->lockedBy = $userId;
    }

    public function markLastRequestNow(): void
    {
        $this->lastRequestDate = new DateTimeImmutable();
    }

    public function regenerateSlug(?string $base = null): void
    {
        $this->slug = $base
            ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($base)))
            : Uuid::uuid4()->toString();
    }

    public function isInState(string $state): bool
    {
        return $this->currentState === $state;
    }

    public function isAuthor(Vendor $vendor = null): bool
    {
        return $vendor && $vendor->getId() === $this->createdBy;
    }

    // === Getters & setters ===

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getModifiedAt(): ?DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?DateTimeImmutable $modifiedAt): void
    {
        $this->modifiedAt = $modifiedAt;
    }

    public function getModifiedBy(): ?int
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(?int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    public function getLockedAt(): ?DateTimeImmutable
    {
        return $this->lockedAt;
    }

    public function setLockedAt(?DateTimeImmutable $lockedAt): void
    {
        $this->lockedAt = $lockedAt;
    }

    public function getLockedBy(): ?int
    {
        return $this->lockedBy;
    }

    public function setLockedBy(?int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    public function setCurrentState(string $currentState): void
    {
        $this->currentState = $currentState ?: 'submitted';
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function getLastRequestDate(): ?DateTimeImmutable
    {
        return $this->lastRequestDate;
    }

    public function setLastRequestDate(?DateTimeImmutable $lastRequestDate): void
    {
        $this->lastRequestDate = $lastRequestDate;
    }
}
