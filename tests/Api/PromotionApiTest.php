<?php
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class PromotionApiTest extends ApiTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            CouponFixtures::class,
            PromotionFixtures::class,
            ProductFixtures::class,
            OrderFixtures::class,
        ]);
    }

    public function testCouponAppliesDiscount(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orders', ['json' => [
            'user' => '/api/users/1',
            'items' => [['product' => '/api/products/1', 'quantity' => 1]],
            'coupon' => '/api/coupons/welcome10'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $order = $client->getResponse()->toArray();
        $this->assertLessThan($order['items'][0]['product']['price'], $order['total']);
    }
}
