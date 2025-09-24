<?php

namespace App\Tests\Entity;

class ProjectTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Project\Project();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
