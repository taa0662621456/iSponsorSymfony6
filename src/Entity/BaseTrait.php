<?php

namespace App\Entity;

use App\Entity\Vendor\Vendor;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;


trait BaseTrait
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
    #[Assert\DateTime(format: 'Y-m-d H:i:s', message: 'Штамп должен соответствовать формату Y-m-d H:i:s')]
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
    private string $lockedAt  = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'locked_by', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $lockedBy = 1;

    #[ORM\Column(name: 'work_flow', type: 'string', nullable: false, options: ['default' => 'submitted', 'comment' => 'Submitted, Spam and Published stats'])]
    private string $workFlow = 'submitted';

    #[ORM\Column(type: 'integer')]
    #[ORM\Version]
    protected int $version;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new \DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    #
    public function getId(): int
    {
        return $this->id;
    }
    #
    public function isPublished(): bool
    {
        return $this->published;
    }
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }
    #
    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
    #
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    #[ORM\PrePersist]
    public function setCreatedAt() : void
    {
        $t = new DateTime();
        $this->createdAt = $t->format('Y-m-d H:i:s');
    }
    #
    public function getLastRequestDate(): string
    {
        return $this->lastRequestDate;
    }
    public function setLastRequestDate(string $lastRequestDate): void
    {
        //TODO: must be setting date owner request only
        $t = new DateTime();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
    }
    #
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }
    #
    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }
    #[ORM\PreUpdate]
    public function setModifiedAt() : void
    {
        $t = new DateTime();
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
    }
    #
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }
    #
    public function getLockedAt(): string
    {
        return $this->lockedAt;
    }
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setLockedAt() : void
    {
        $t = new DateTime();
        $this->lockedAt = $t->format('Y-m-d H:i:s');
    }
    #
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }
    #
    public function getWorkFlow(): string
    {
        return $this->workFlow;
    }
    public function setWorkFlow(string $workFlow): void
    {
        $this->workFlow = $workFlow ?? 'submitted';
    }
    #
    public function getVersion(): int
    {
        return $this->version;
    }
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }
    #
    #[Pure]
    public function isAuthor(Vendor $vendor = null): bool
    {
        return $vendor && $vendor->getId() == $this->getCreatedBy();
    }



}
