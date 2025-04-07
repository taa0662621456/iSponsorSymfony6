<?php

namespace App\Entity\Embeddable;

use App\Entity\Vendor\Vendor;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\StateMachine;
use Symfony\Component\Workflow\Transition;

/**
 * @property string $lastRequestDate
 */
#[ORM\UniqueConstraint(name: 'vendor_security_idx', columns: ['slug'])]
#[ORM\Embeddable]
class ObjectProperty
{
    #[ORM\Column(name: 'published', type: 'boolean', nullable: true)]
    private bool $published = true;

    #[ORM\Column(name: 'slug', type: 'string', unique: true, nullable: true)]
    private string $slug;

    #[ORM\Column(name: 'created_at', type: 'string', nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $createdAt = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'created_by', type: 'integer', nullable: true, options: ['default' => 1])]
    private int $createdBy = 1;

    #[ORM\Column(name: 'modified_at', type: 'string', nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $modifiedAt = 'Y-m-d H:i:s';

    #[ORM\Column(name: 'modified_by', type: 'integer', nullable: true, options: ['default' => 1])]
    private int $modifiedBy = 1;

    #[ORM\Column(name: 'locked_at', type: 'string', nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $lockedAt = 'Y-m-d H:i:s';

    #[Groups(['read', 'write'])]
    #[ORM\Column(name: 'locked_by', type: 'integer', nullable: true, options: ['default' => 1])]
    private int $lockedBy = 1;

    #[ORM\Column(name: 'current_state', type: 'string', nullable: true, options: ['default' => 'submitted', 'comment' => 'Submitted, Spam and Published stats'])]
    protected string $currentState = 'submitted';

    #[ORM\Column(type: 'integer', nullable: true)]
    #[ORM\Version]
    protected int $version;

    public function __construct()
    {
        $this->slug = Uuid::uuid4();
        $definitionBuilder = new DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['state1', 'state2', 'state3'])
            ->addTransition(new Transition('transition1', 'state1', 'state2'))
            ->addTransition(new Transition('transition2', 'state2', 'state3'))
            ->build();

        $workflow = new StateMachine(
            $definition,
            new MethodMarkingStore(true)
        );
    }

    public function setLastRequestDate(string $lastRequestDate): void
    {
        // TODO: must be setting date owner request only
        $t = new DateTime();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
    }

    public function setCurrentState(string $currentState): void
    {
        $this->currentState = $currentState ?? 'submitted';
    }

    public function applyTransition($transition): void
    {
        $definitionBuilder = new DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['state1', 'state2', 'state3'])
            ->addTransition(new Transition('transition1', 'state1', 'state2'))
            ->addTransition(new Transition('transition2', 'state2', 'state3'))
            ->build();

        $workflow = new StateMachine(
            $definition,
            new MethodMarkingStore(true)
        );

        // Проверяем, допустим ли переход
        if ($workflow->can($this, $transition)) {
            // Применяем переход
            $workflow->apply($this, $transition);
        }
    }

    public function getAvailableTransitions(): array
    {
        $definitionBuilder = new DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['state1', 'state2', 'state3'])
            ->addTransition(new Transition('transition1', 'state1', 'state2'))
            ->addTransition(new Transition('transition2', 'state2', 'state3'))
            ->build();

        $workflow = new StateMachine(
            $definition,
            new MethodMarkingStore(true)
        );

        return $workflow->getEnabledTransitions($this);
    }

    #[Pure]
    public function isAuthor(Vendor $vendor = null): bool
    {
        return $vendor && $vendor->getId() == $this->getCreatedBy();
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
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
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
     * @param string $modifiedAt
     */
    public function setModifiedAt(string $modifiedAt): void
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
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
     * @param string $lockedAt
     */
    public function setLockedAt(string $lockedAt): void
    {
        $this->lockedAt = $lockedAt;
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
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
}
