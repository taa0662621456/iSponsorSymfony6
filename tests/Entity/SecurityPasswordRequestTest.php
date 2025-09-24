<?php

namespace App\Tests\Entity;

class SecurityPasswordRequestTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Security\SecurityPasswordRequest();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
