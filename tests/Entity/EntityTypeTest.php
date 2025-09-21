<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityType;
use App\DataTransferObject\ObjectProps;
use PHPUnit\Framework\TestCase;

class EntityTypeTest extends TestCase
{
    public function testBuildEntityType(): void
    {
        $props = new ObjectProps(entity: 'Vendor', subEntity: 'Profile', action: 'view');
        $typeBuilder = new EntityType();

        $type = $typeBuilder->getEntityTypeName($props);

        $this->assertSame('VendorProfile', $type);
    }

    public function testBuildEntityTypeNamespace(): void
    {
        $props = new ObjectProps(entity: 'Vendor', subEntity: 'Profile', action: 'view');
        $typeBuilder = new EntityType();

        $namespace = $typeBuilder->getEntityTypeNamespace($props);

        $this->assertSame('App\Form\Vendor\VendorProfileType', $namespace);
    }
}

