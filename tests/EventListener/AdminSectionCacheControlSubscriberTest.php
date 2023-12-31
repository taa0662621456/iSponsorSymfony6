<?php

namespace EventListener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AdminSectionCacheControlSubscriberTest extends WebTestCase
{
    public function testItReturnsProperCacheHeadersForAdminEndpoints(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin/');

        $this->assertResponseHeaderSame('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}
