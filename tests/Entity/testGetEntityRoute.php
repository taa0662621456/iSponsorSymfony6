<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class testGetEntityRoute
{
    public function testGetRoutePath(): void
    {
        $request = new Request([], [], ['entity' => 'User', 'subEntity' => 'Profile']);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')->willReturn($request);

        $service = new EntityRoute($requestStack);

        $routePath = $service->getRoute();
        $this->assertSame('UserProfile', $routePath);
    }

}
