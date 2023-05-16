<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class RoutingCode200Test extends WebTestCase
{
    /**
     * @throws \Exception
     */
    public function testRoutes()
    {
        $client = self::createClient();
        $router = self::getContainer()->get('router');

        $routes = $router->getRouteCollection();

        foreach ($routes as $route) {
            $path = $route->getPath();
            $method = $route->getMethods()[0];

            $client->request($method, $path);
            $statusCode = $client->getResponse()->getStatusCode();

            $this->assertEquals(200, $statusCode, "Failed to access route: $method $path");
        }
    }
}

