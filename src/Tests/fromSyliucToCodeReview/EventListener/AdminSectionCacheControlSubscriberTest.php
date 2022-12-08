<?php


namespace App\Tests\EventListener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AdminSectionCacheControlSubscriberTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_returns_proper_cache_headers_for_admin_endpoints(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin/');

        $this->assertResponseHeaderSame('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}
