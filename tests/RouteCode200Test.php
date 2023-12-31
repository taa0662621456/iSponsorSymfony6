<?php

namespace App\Tests;

use App\Tests\BaseWebTestCase;


class RouteCode200Test extends BaseWebTestCase
{
    /**
     * @throws \Exception
     */
    public function testRoutes()
    {
        $router = static::getContainer()->get('router');
        $routes = $router->getRouteCollection();

        foreach ($routes as $route) {
            $path = $route->getPath();
            $methods = $route->getMethods();
            $method = !empty($methods) ? $methods[0] : 'GET';

            // Для динамических путей, здесь может потребоваться дополнительная логика.

            static::$client->request($method, $path);
            $statusCode = static::$client->getResponse()->getStatusCode();

            $this->assertEquals(200, $statusCode, "Failed to access route: $method $path");
        }
    }
}
