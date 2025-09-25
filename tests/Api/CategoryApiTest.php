<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class CategoryApiTest extends WebTestCase
{
    use FixturesTrait;

    public function testSmoke(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
