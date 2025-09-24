<?php

namespace App\Tests\Service;

use App\Service\Entity\EntityRepository;
use App\ServiceInterface\Entity\EntityRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class EntityRepositoryTest extends TestCase
{
    public function testInvalidClassThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $managerRegistry = $this->createMock(ManagerRegistry::class);
        $repository = new EntityRepository($managerRegistry, new NullLogger());
        $repository->createEntityRepositoryObject('NonExistentClass');
    }

    public function testValidClassReturnsObject(): void
    {
        $managerRegistry = $this->createMock(ManagerRegistry::class);
        $fakeRepo = new \stdClass();
        $managerRegistry->method('getRepository')->willReturn($fakeRepo);

        $repository = new EntityRepository($managerRegistry, new NullLogger());
        $result = $repository->createEntityRepositoryObject(\stdClass::class);
        $this->assertInstanceOf(\stdClass::class, $result);
    }
}
