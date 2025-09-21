<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityRoute;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use PHPUnit\Framework\TestCase;

class EntityRouteTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetRoute(): void
    {
        $request = new Request([], [], ['entity' => 'User', 'subEntity' => 'Profile']);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')->willReturn($request);

        $routeBuilder = new EntityRoute($requestStack);

        $route = $routeBuilder->getEntityRouteNamespace();
        $this->assertSame('UserProfile', $route);
    }

    /**
     * @throws Exception
     */
    public function testFallbackRoute(): void
    {
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')->willReturn(null);

        $routeBuilder = new EntityRoute($requestStack);

        $route = $routeBuilder->getEntityRouteNamespace();
        $this->assertSame('Root', $route);
    }
}

