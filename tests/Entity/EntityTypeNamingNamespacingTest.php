<?php

namespace App\Tests\Entity;

class EntityTypeNamingNamespacingTest extends EntityAbstractBuilderTest
{
    public function testItBuildsEntityTypeName(): void
    {
        $props = $this->createProps('User', 'Profile');
        $builder = new EntityType();

        $this->assertSame('UserProfile', $builder->getEntityTypeName($props));
    }

    public function testItBuildsEntityTypeNamespace(): void
    {
        $props = $this->createProps('User', 'Profile');
        $builder = new EntityType();

        $this->assertSame('App\Form\UserProfileType', $builder->getEntityTypeNamespace($props));
    }
}
