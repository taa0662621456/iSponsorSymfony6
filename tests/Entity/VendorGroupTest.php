<?php

namespace App\Tests\Entity;

class VendorGroupTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Vendor\VendorGroup();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
