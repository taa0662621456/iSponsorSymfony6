<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'permission_change_log')]
class RolePermissionChangeLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $role;

    #[ORM\Column(type: 'string', length: 50)]
    private string $permission;

    #[ORM\Column(type: 'string', length: 20)]
    private string $action; // grant | revoke

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $changedAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $changedBy = null; // username/email

    public function getId(): int { return $this->id; }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): self { $this->role = $role; return $this; }

    public function getPermission(): string { return $this->permission; }
    public function setPermission(string $permission): self { $this->permission = $permission; return $this; }

    public function getAction(): string { return $this->action; }
    public function setAction(string $action): self { $this->action = $action; return $this; }

    public function getChangedAt(): \DateTimeInterface { return $this->changedAt; }
    public function setChangedAt(\DateTimeInterface $dt): self { $this->changedAt = $dt; return $this; }

    public function getChangedBy(): ?string { return $this->changedBy; }
    public function setChangedBy(?string $by): self { $this->changedBy = $by; return $this; }
}
