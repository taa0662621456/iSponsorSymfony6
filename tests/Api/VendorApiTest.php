<?php
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class VendorApiTest extends ApiTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            VendorFixtures::class,
            VendorProfileFixtures::class,
        ]);
    }

    public function testVendorCreatedWithProfile(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/vendors', ['json' => [
            'name' => 'Test Vendor',
            'profile' => '/api/vendor_profiles/1'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['name' => 'Test Vendor']);
    }
}
