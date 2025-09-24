<?php

namespace App\Tests\Entity;

class ShipmentTest extends AbstractEntityTestCase
{
    protected function getEntity(): object
    {
        return new \App\Entity\Shipment\Shipment();
    }

    public function entityFieldProvider(): array
    {
        return [
            ['setMetaAuthor', 'getMetaAuthor', 'system'],
            ['setMetaRobot', 'getMetaRobot', 'index,follow'],
        ];
    }
}
