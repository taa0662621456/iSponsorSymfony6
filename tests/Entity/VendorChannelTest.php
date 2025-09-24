<?php

namespace App\Tests\Entity;

class VendorChannelTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Vendor\VendorChannel();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
