<?php

use App\DataFixtures\Coupon\CouponFixtures;
use App\DataFixtures\Order\OrderFixtures;
use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\PromotionFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class CouponControllerTest extends WebTestCase
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

    public function testCouponAppliesOnCheckout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/coupon/apply?code=welcome10&order=1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.order-total', 'discount');
    }
}
