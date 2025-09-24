<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Entity]
#[ORM\Table(name: 'idempotency_keys', uniqueConstraints: [new ORM\UniqueConstraint(name: 'uniq_idemp_key', columns: ['key_hash'])])]
class IdempotencyKeyEntity
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;

    #[ORM\Column(type: 'string', length: 64, unique: true)]
    private string $keyHash;

    #[ORM\Column(type: 'string', length: 100)]
    private string $scope; // например: order:place:USER_ID

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $response = null;

    public static function hash(?string $key): string
    {
        return hash('sha256', (string) $key);
    }

}