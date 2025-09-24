<?php

namespace App\Tests\Entity;

class PropertyTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Property\Property();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
