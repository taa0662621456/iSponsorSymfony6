<?php


namespace EventListener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShopCustomerAccountSubSectionCacheControlSubscriberTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_returns_proper_cache_headers_for_customer_account_endpoints(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en_US/account/');

        $this->assertResponseHeaderSame('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}
