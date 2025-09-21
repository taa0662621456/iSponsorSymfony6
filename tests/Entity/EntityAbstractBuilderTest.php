<?php

namespace App\Tests\Entity;

use App\DataTransferObject\ObjectProps;
use PHPUnit\Framework\TestCase;

abstract class EntityAbstractBuilderTest extends TestCase
{
    protected function createProps(
        string $entity = 'User',
        ?string $subEntity = 'Profile',
        ?string $action = 'view'
    ): ObjectProps {
        return new ObjectProps($entity, $subEntity, $action);
    }
}
