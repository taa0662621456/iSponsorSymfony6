<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;

abstract class AbstractEntityTestCase extends TestCase
{
    abstract protected function getEntity(): object;

    /**
     * @dataProvider entityFieldProvider
     */
    public function testGettersAndSetters(string $setter, string $getter, mixed $value): void
    {
        $entity = $this->getEntity();
        $entity->$setter($value);
        $this->assertEquals($value, $entity->$getter());
    }

    public function testLifecycleCallbacks(): void
    {
        $entity = $this->getEntity();

        if (method_exists($entity, 'onPrePersist')) {
            $entity->onPrePersist();
            if (method_exists($entity, 'getObjectPropertySlug')) {
                $this->assertNotNull($entity->getObjectPropertySlug());
            }
            if (method_exists($entity, 'getObjectPropertyCreatedAt')) {
                $this->assertNotNull($entity->getObjectPropertyCreatedAt());
            }
        }

        if (method_exists($entity, 'onPreUpdate')) {
            $entity->onPreUpdate();
            if (method_exists($entity, 'getObjectPropertyModifiedAt')) {
                $this->assertNotNull($entity->getObjectPropertyModifiedAt());
            }
        }
    }

    public function testDefaultMetaValues(): void
    {
        $entity = $this->getEntity();

        if (method_exists($entity, 'getMetaAuthor')) {
            $this->assertEquals('system', $entity->getMetaAuthor());
        }
        if (method_exists($entity, 'getMetaRobot')) {
            $this->assertEquals('index,follow', $entity->getMetaRobot());
        }
    }
}
