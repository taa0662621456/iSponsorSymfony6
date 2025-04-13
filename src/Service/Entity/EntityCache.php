<?php

namespace App\Service\Entity;

class EntityCache
{
    private array $cache = [
        'routeProps' => [],
        'objectType' => [],
        'objectProps' => []
    ];

    public function get(string $key, string $subKey): mixed
    {
        return $this->cache[$key][$subKey] ?? null;
    }

    public function set(string $key, string $subKey, mixed $value): void
    {
        $this->cache[$key][$subKey] = $value;
    }

    public function clear(): void
    {
        $this->cache = [
            'routeProps' => [],
            'objectType' => [],
            'objectProps' => []
        ];
    }

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


}
