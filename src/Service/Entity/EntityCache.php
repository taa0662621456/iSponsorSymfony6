<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;

class EntityCache
{
    private array $cache = [
        'routeProps' => [],
        'objectType' => [],
        'objectProps' => []
    ];

    private array $localCache = [];
    private array $expirationTimes = [];

    public function setWithTTL(string $key, mixed $value, int $ttl): void
    {
        $this->localCache[$key] = $value;
        $this->expirationTimes[$key] = time() + $ttl;
    }

    public function get(string $key): mixed
    {
        if (isset($this->expirationTimes[$key]) && $this->expirationTimes[$key] < time()) {
            unset($this->localCache[$key], $this->expirationTimes[$key]);
            return null;
        }

        return $this->localCache[$key] ?? null;
    }

    public function clear(): void
    {
        $this->localCache = [];
        $this->expirationTimes = [];
    }

    public function initializeObject(string $entity, ?string $subEntity = null, ?string $crudAction = 'index'): ObjectProps
    {
        if (!$entity) {
            $this->logger->error('Entity name is missing during initialization.');
            throw new \InvalidArgumentException('Entity name is required for initialization.');
        }

        return new ObjectProps(
            entity: $entity,
            subEntity: $subEntity,
            //crudAction: $crudAction
        );
    }
}
