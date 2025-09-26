<?php
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class OrderApiTest extends ApiTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            UserFixtures::class,
            ProductFixtures::class,
            OrderStatusFixtures::class,
            OrderFixtures::class,
            PaymentFixtures::class,
            ShipmentFixtures::class,
        ]);
    }

    public function testFullOrderFlow(): void
    {
        $client = static::createClient();

        // Create Order
        $client->request('POST', '/api/orders', ['json' => [
            'user' => '/api/users/1',
            'items' => [['product' => '/api/products/1', 'quantity' => 1]],
        ]]);
        $this->assertResponseStatusCodeSame(201);
        $order = $client->getResponse()->toArray();

        // Pay Order
        $client->request('POST', '/api/payments', ['json' => [
            'order' => $order['@id'],
            'method' => '/api/payment_methods/1',
            'amount' => 100
        ]]);
        $this->assertResponseStatusCodeSame(201);

        // Ship Order
        $client->request('POST', '/api/shipments', ['json' => [
            'order' => $order['@id'],
            'method' => '/api/shipment_methods/1'
        ]]);
        $this->assertResponseStatusCodeSame(201);

        // Check final status
        $client->request('GET', $order['@id']);
        $this->assertJsonContains(['status' => 'shipped']);
    }
}
