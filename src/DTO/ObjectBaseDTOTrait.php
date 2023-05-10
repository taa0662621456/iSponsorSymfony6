<?php

namespace App\DTO;

use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ObjectBaseDTOTrait
{
    protected ?int $id = null;

    private bool $published = true;

    private string $slug;

    #[Assert\DateTime(format: 'Y-m-d H:i:s', message: 'Штамп должен соответствовать формату Y-m-d H:i:s')]
    private string $createdAt = 'Y-m-d H:i:s';

    private int $createdBy = 1;

    #[Groups(['vendor:list', 'vendor:item'])]

    private string $lastRequestDate = 'Y-m-d H:i:s';

    private string $modifiedAt = 'Y-m-d H:i:s';

    private int $modifiedBy = 1;

    private string $lockedAt = 'Y-m-d H:i:s';

    #[Groups(['read', 'write'])]

    private int $lockedBy = 1;

    private string $workFlow = 'submitted';

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

    public function setCreatedAt(): void
    {
        $t = new DateTime();
    }

    public function getLastRequestDate(): string
    {
        return $this->lastRequestDate;
    }

    public function setLastRequestDate(string $lastRequestDate): void
    {
        // TODO: must be setting date owner request only
        $t = new DateTime();
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

    public function setModifiedAt(): void
    {
        $t = new DateTime();
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

    public function setLockedAt(): void
    {
        $t = new DateTime();
    }

    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

    public function getWorkFlow(): string
    {
        return $this->workFlow;
    }

    public function setWorkFlow(string $workFlow): void
    {
        $this->workFlow = $workFlow ?? 'submitted';
    }

}
