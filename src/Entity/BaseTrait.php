<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Payum\Core\Security\CypherInterface;

trait BaseTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(name: 'published', type: 'boolean', options: ['default' => true])]
    #[Groups(['read','write'])]
    private bool $published = true;

    #[ORM\Column(name: 'slug', type: 'string', unique: true)]
    private string $slug;

    #[ORM\Column(name: 'code', type: 'string', unique: true)]
    private string $code;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Groups(['read','write'])]
    private string $token;

    #[ORM\Column(type: 'json', nullable: true)]
    protected ?array $config = [];

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    protected bool $configEncrypted = false;

    protected array $decryptedConfig = [];

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $lastConfigUpdate = null;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'modified_at', type: 'datetime_immutable')]
    private \DateTimeImmutable $modifiedAt;

    #[ORM\Column(name: 'last_request_date', type: 'datetime_immutable')]
    private \DateTimeImmutable $lastRequestAt;

    #[ORM\Column(name: 'locked_at', type: 'datetime_immutable')]
    private \DateTimeImmutable $lockedAt;

    #[ORM\Column(name: 'created_by', type: 'integer', options: ['default' => 1])]
    private int $createdBy = 1;

    #[ORM\Column(name: 'modified_by', type: 'integer', options: ['default' => 1])]
    private int $modifiedBy = 1;

    #[Groups(['read', 'write'])]
    #[ORM\Column(name: 'locked_by', type: 'integer', options: ['default' => 1])]
    private int $lockedBy = 1;

    #[ORM\Column(name: 'work_flow', type: 'string', options: ['default' => 'submitted'])]
    private string $workFlow = 'submitted';

    #[ORM\Version]
    #[ORM\Column(type: 'integer')]
    protected int $version = 1;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['read','write'])]
    private ?\DateTimeImmutable $expiresAt = null;

    #[ORM\Column(type: 'json', nullable: true)]
    #[Groups(['read','write'])]
    private ?array $ipRestriction = [];

    #region Lifecycle

    #[ORM\PrePersist]
    public function initializeTimestamps(): void
    {
        $t = new \DateTimeImmutable();
        $this->slug = $this->slug ?? (string)Uuid::v4();
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lastRequestAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }

    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->modifiedAt = new \DateTimeImmutable();
    }

    public function getConfig(bool $decrypted = true): ?array
    {
        return ($this->configEncrypted && $decrypted)
            ? $this->decryptedConfig
            : $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
        $this->decryptedConfig = $config;
        $this->lastConfigUpdate = new \DateTimeImmutable();
    }

    public function isConfigEncrypted(): bool
    {
        return $this->configEncrypted;
    }

    public function setConfigEncrypted(bool $flag): void
    {
        $this->configEncrypted = $flag;
    }

    public function encryptConfig(CypherInterface $cypher): void
    {
        $this->configEncrypted = true;
        $encrypted = [];

        foreach ($this->decryptedConfig as $key => $value) {
            $encrypted[$key] = (is_bool($value) || $key === 'encrypted')
                ? $value
                : $cypher->encrypt((string)$value);
        }

        $this->config = $encrypted;
        $this->lastConfigUpdate = new \DateTimeImmutable();
    }

    public function decryptConfig(CypherInterface $cypher): void
    {
        if (!$this->configEncrypted || empty($this->config)) {
            $this->decryptedConfig = $this->config ?? [];
            return;
        }

        $decrypted = [];
        foreach ($this->config as $key => $value) {
            $decrypted[$key] = (is_bool($value) || $key === 'encrypted')
                ? $value
                : $cypher->decrypt((string)$value);
        }

        $this->decryptedConfig = $decrypted;
        $this->lastConfigUpdate = new \DateTimeImmutable();
    }

    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeImmutable $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    #
    public function getIpRestriction(): array
    {
        return $this->ipRestriction ?? [];
    }

    public function setIpRestriction(array $ips): void
    {
        $this->ipRestriction = $ips;
    }

    public function isIpAllowed(string $ip): bool
    {
        if (empty($this->ipRestriction)) {
            return true;
        }
        return in_array($ip, $this->ipRestriction, true);
    }
}