<?php

namespace App\Tests\Entity;

class ProductTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Product\Product();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
