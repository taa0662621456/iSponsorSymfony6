<?php

namespace App\Tests\Entity;


use App\Service\Entity\EntityNamingNamespacing;

final class EntityNameNamingNamespacingTest extends EntityAbstractBuilderTest
{
    public function testItBuildsEntityClassName(): void
    {
        $props = $this->createProps('Order', 'Item');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('OrderItem', $builder->getEntityClassName($props));
    }

    public function testItBuildsEntityClassNamespace(): void
    {
        $props = $this->createProps('Order', 'Item');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\Entity\OrderItem', $builder->getEntityClassNamespace($props));
    }

    public function testItBuildsEntityRepositoryNamespace(): void
    {
        $props = $this->createProps('Order', 'Item');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\Repository\OrderItemRepository', $builder->getEntityRepositoryNamespace($props));
    }

    public function testItBuildsEntityTypeNamespace(): void
    {
        $props = $this->createProps('Order', 'Item');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\Form\OrderItemType', $builder->getEntityTypeNamespace($props));
    }
}
