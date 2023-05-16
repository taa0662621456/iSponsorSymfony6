<?php

namespace App\Entity;

use JetBrains\PhpStorm\Pure;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait ObjectBaseTrait
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected ?int $id = null;

    #[ORM\Column(name: 'published', type: 'boolean', nullable: false)]
    private bool $published = true;

    #[ORM\Column(name: 'slug', type: 'string', unique: true, nullable: false)]
    private string $slug;

    #[ORM\Column(name: 'created_at', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $createdAt = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'created_by', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $createdBy = 1;

    #[Groups(['vendor:list', 'vendor:item'])]
    #[ORM\Column(name: 'last_request_date', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Owned request last time'])]
    private string $lastRequestDate = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'modified_at', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $modifiedAt = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'modified_by', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $modifiedBy = 1;

    #[ORM\Column(name: 'locked_at', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $lockedAt = 'Y-m-d H:i:s';

    #[Groups(['read', 'write'])]
    #[ORM\Column(name: 'locked_by', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $lockedBy = 1;

    #[ORM\Column(name: 'current_state', type: 'string', nullable: false, options: ['default' => 'submitted', 'comment' => 'Submitted, Spam and Published stats'])]
    private string $currentState = 'submitted';

    #[ORM\Column(type: 'integer')]
    #[ORM\Version]
    protected int $version;

    public function getId(): int
    {
        return $this->id;
    }

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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $t = new \DateTime();
        $this->createdAt = $t->format('Y-m-d H:i:s');
    }

    public function getLastRequestDate(): string
    {
        return $this->lastRequestDate;
    }

    public function setLastRequestDate(string $lastRequestDate): void
    {
        // TODO: must be setting date owner request only
        $t = new \DateTime();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
    }

    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }

    #[ORM\PreUpdate]
    public function setModifiedAt(): void
    {
        $t = new \DateTime();
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
    }

    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    public function getLockedAt(): string
    {
        return $this->lockedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setLockedAt(): void
    {
        $t = new \DateTime();
        $this->lockedAt = $t->format('Y-m-d H:i:s');
    }

    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    public function setCurrentState(string $currentState): void
    {
        $this->currentState = $currentState ?? 'submitted';
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    #[Pure]
    public function isAuthor(Vendor $vendor = null): bool
    {
        return $vendor && $vendor->getId() == $this->getCreatedBy();
    }
}
