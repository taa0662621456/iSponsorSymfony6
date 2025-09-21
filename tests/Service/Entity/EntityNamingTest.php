<?php

namespace App\Tests\Service\Entity;

use App\DataTransferObject\ObjectProps;
use App\Service\Entity\EntityNamingNamespacing;
use PHPUnit\Framework\TestCase;

class EntityNamingTest extends TestCase
{
    public function testGetEntityClassNameWithSubEntity(): void
    {
        $props = new ObjectProps(entity: 'Order', subEntity: 'Item', action: 'create');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('OrderItem', $builder->getEntityClassName($props));
    }

    public function testGetEntityClassNameWithoutSubEntity(): void
    {
        $props = new ObjectProps(entity: 'Order', subEntity: null, action: 'create');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('Order', $builder->getEntityClassName($props));
    }

    public function testGetEntityClassNamespace(): void
    {
        $props = new ObjectProps(entity: 'Order', subEntity: 'Item', action: 'create');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\\Entity\\OrderItem', $builder->getEntityClassNamespace($props));
    }

    public function testGetEntityRepositoryNamespace(): void
    {
        $props = new ObjectProps(entity: 'Order', subEntity: 'Item', action: 'create');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\\Repository\\OrderItemRepository', $builder->getEntityRepositoryNamespace($props));
    }

    public function testGetEntityTypeNamespace(): void
    {
        $props = new ObjectProps(entity: 'Order', subEntity: 'Item', action: 'create');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('App\\Form\\OrderItemType', $builder->getEntityTypeNamespace($props));
    }
}
