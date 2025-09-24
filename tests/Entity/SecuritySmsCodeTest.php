<?php

namespace App\Tests\Entity;

class SecuritySmsCodeTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Security\SecuritySmsCode();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
