<?php

namespace App\Tests\Entity;

use App\DataTransferObject\ObjectProps;
use App\Service\Entity\EntityNamingNamespacing;
use PHPUnit\Framework\TestCase;

class EntityFullNamespacingBuilderTest extends TestCase
{
    private function createProps(
        string $entity = 'User',
        ?string $subEntity = 'Profile',
        ?string $action = 'view'
    ): ObjectProps {
        return new ObjectProps($entity, $subEntity, $action);
    }

    public function testEntityNameBuilder(): void
    {
        $props = $this->createProps('Order', 'Item');
        $builder = new EntityNamingNamespacing();

        $this->assertSame('OrderItem', $builder->getEntityClassName($props));
        $this->assertSame('App\Entity\OrderItem', $builder->getEntityClassNamespace($props));
        $this->assertSame('App\Repository\OrderItemRepository', $builder->getEntityRepositoryNamespace($props));
        $this->assertSame('App\Form\OrderItemType', $builder->getEntityTypeNamespace($props));
    }

    public function testEntityTypeBuilder(): void
    {
        $props = $this->createProps('User', 'Profile');
        $builder = new EntityTypeNamingNamespacingTest();

        $this->assertSame('UserProfile', $builder->getEntityTypeName($props));
        $this->assertSame('App\Form\UserProfileType', $builder->getEntityTypeNamespace($props));
    }

}
