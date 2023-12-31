<?php

namespace EventListener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShopCustomerAccountSubSectionCacheControlSubscriberTest extends WebTestCase
{
    public function testItReturnsProperCacheHeadersForCustomerAccountEndpoints(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en_US/account/');

        $this->assertResponseHeaderSame('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}
