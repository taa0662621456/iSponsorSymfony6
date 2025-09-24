<?php

namespace App\Tests\Entity;

class RoleTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\User\Role();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
