<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityCache;
use PHPUnit\Framework\TestCase;

class EntityCacheTest extends TestCase
{
    private EntityCache $cache;

    protected function setUp(): void
    {
        $this->cache = new EntityCache();
    }

    public function testSetAndGetWithTTL(): void
    {
        $key = 'testKey';
        $value = 'testValue';

        $this->cache->setWithTTL($key, $value, 5); // TTL: 5 seconds
        $this->assertSame($value, $this->cache->get($key));

        sleep(6); // Ждем, пока TTL истечет
        $this->assertNull($this->cache->get($key));
    }

    public function testClearCache(): void
    {
        $key = 'testKey';
        $value = 'testValue';

        $this->cache->setWithTTL($key, $value, 60); // Устанавливаем значение
        $this->cache->clear(); // Чистим кэш

        $this->assertNull($this->cache->get($key)); // Должно быть пусто
    }
}
