<?php
namespace App\Interface;

use App\Entity\Vendor\Vendor;
use App\Service\RequestDispatcher;
use Doctrine\Common\Collections\Collection;

interface BaseInterface
{
    public function getId(): int;

    public function isPublished(): bool;

    public function setPublished(bool $published): void;

    public function getSlug(): string;

    public function setSlug(string $slug): void;

    public function getCreatedAt(): string;

    public function setCreatedAt() : void;

    public function getLastRequestDate(): string;

    public function setLastRequestDate(string $lastRequestDate): void;

    public function getCreatedBy(): int;

    public function setCreatedBy(int $createdBy): void;

    public function getModifiedAt(): string;

    public function setModifiedAt() : void;

    public function getModifiedBy(): int;

    public function setModifiedBy(int $modifiedBy): void;

    public function getLockedAt(): string;

    public function setLockedAt() : void;

    public function getLockedBy(): int;

    public function setLockedBy(int $lockedBy): void;

    public function getWorkFlow(): string;

    public function setWorkFlow(string $workFlow): void;

    public function getVersion(): int;

    public function setVersion(int $version): void;

    public function isAuthor(Vendor $vendor = null): bool;

}
