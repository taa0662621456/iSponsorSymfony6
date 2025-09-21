<?php

namespace App\ServiceInterface\Entity;

interface EntityCacheInterface
{
    public function set(string $key, mixed $value): void;
    public function get(string $key): mixed;
    public function clear(): void;

}
