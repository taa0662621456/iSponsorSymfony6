<?php

namespace App\Tests\Entity;

class SecurityApiTokenTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Security\SecurityApiToken();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
