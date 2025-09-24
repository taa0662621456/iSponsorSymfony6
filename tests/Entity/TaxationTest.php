<?php

namespace App\Tests\Entity;

class TaxationTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Taxation\Taxation();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
