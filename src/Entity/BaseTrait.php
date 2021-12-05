<?php

namespace App\Entity;

use App\Entity\Vendor\Vendor;
use App\Service\RequestDispatcher;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;


trait BaseTrait
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * Groups({"object:list", "object:item"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private bool $published = true;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", unique=true, nullable=false)
     */
    private string $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     *
     * @Assert\DateTime(format="Y-m-d H:i:s", message="Штамп должен соответствовать формату Y-m-d H:i:s")
     */
    private string $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
     */
    private int $createdBy = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="last_request_date", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP",
     *     "comment"="Owned request last time"})
     */
    #[Groups(['vendor:list', 'vendor:item'])]
    private string $lastRequestDate;

    /**
     * @var string
     *
     * @ORM\Column(name="modified_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private string $modifiedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
     */
    private int $modifiedBy = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="locked_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private string $lockedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
     */
    private int $lockedBy = 1;

    /**
     * @var string
     * @ORM\Column(name="work_flow", type="string", nullable=false,
     *     options={"default"="submitted", "comment"="Submitted, Spam and Published stats"})
     */
    private string $workFlow = 'submitted';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Version
     */
    protected int $version;
    /**
     * @var RequestDispatcher
     */
    private RequestDispatcher $requestDispatcher;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    /**
     * @return Collection
     */
    public function getAttachments():Collection
    {
        return $this->attachments;
    }

    public function setAttachments(RequestDispatcher $requestDispatcher): void
    {
        $object = $requestDispatcher->object();
        $object = new $object;
        $this->attachments = $object;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }


    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    public function setCreatedAt(): void
    {
        $t = new DateTime();
        $this->createdAt = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getLastRequestDate(): string
    {
        return $this->lastRequestDate;
    }

    /**
     * @param string $lastRequestDate
     */
    public function setLastRequestDate(string $lastRequestDate): void
    {
        //TODO: must be setting date owner request only
        $t = new DateTime();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param integer $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return string
     */
    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function setModifiedAt(): void
    {
        $t = new DateTime();
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return integer
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param integer $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return string
     */
    public function getLockedAt(): string
    {
        return $this->lockedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function setLockedAt(): void
    {
        $t = new DateTime();
        $this->lockedAt = $t->format('Y-m-d H:i:s');
    }


    /**
     * @return integer
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param integer $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

    /**
     * @return string
     */
    public function getWorkFlow(): string
    {
        return $this->workFlow;
    }

    /**
     * @param string $workFlow
     */
    public function setWorkFlow(string $workFlow): void
    {
        $this->workFlow = $workFlow ?? 'submitted';
    }


    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
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
