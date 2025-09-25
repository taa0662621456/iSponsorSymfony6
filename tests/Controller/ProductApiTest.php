<?php

namespace App\Tests\Controller;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\Product\ProductTypeFixtures;

final class ProductApiTest extends ApiTestCase
{
    use FixturesTrait;

    public function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            ProductTypeFixtures::class,
            ProductFixtures::class,
        ]);
    }

    public function testGetProducts(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            ['name' => 'Product 1'],
        ]);
    }

    public function testCreateProduct(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/products', [
            'json' => [
                'name' => 'New Product',
                'price' => 199,
                'type' => '/api/product_types/1',
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['name' => 'New Product']);
    }
}

