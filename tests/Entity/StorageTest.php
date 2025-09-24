<?php

namespace App\Tests\Entity;

class StorageTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Storage\Storage();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
