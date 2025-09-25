<?php
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class ProductApiTest extends ApiTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            VendorFixtures::class,
            CategoryFixtures::class,
            ProductFixtures::class,
        ]);
    }

    public function testCreateProductWithVendorAndCategory(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/products', ['json' => [
            'name' => 'Vendor Product',
            'price' => 300,
            'vendor' => '/api/vendors/1',
            'category' => '/api/categories/1'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['name' => 'Vendor Product']);
    }
}
