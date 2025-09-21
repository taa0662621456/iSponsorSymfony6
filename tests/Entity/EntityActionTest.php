<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityAction;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class EntityActionTest extends TestCase
{
    private EntityAction $action;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $requestStack = $this->createMock(RequestStack::class);
        $logger = $this->createMock(LoggerInterface::class);

        $this->action = new EntityAction($requestStack, $logger);
    }

    public function testGetCrudActionName(): void
    {
        $request = new Request([], [], ['_route' => 'entity_create']);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')->willReturn($request);

        $logger = $this->createMock(LoggerInterface::class);
        $action = new EntityAction($requestStack, $logger);

        $this->assertSame('create', $action->getEntityCrudActionName());
    }

    /**
     * @throws Exception
     */
    public function testInvalidRoute(): void
    {
        $request = new Request([], [], ['_route' => 'invalid_route']);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')->willReturn($request);

        $logger = $this->createMock(LoggerInterface::class);
        $action = new EntityAction($requestStack, $logger);

        $this->assertNull($action->getEntityCrudActionName());
    }
}
