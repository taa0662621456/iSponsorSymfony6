<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class HomepageControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->loadFixtures([
            LocaleFixtures::class,
            CategoryFixtures::class,
            ProductFixtures::class,
            FeaturedFixtures::class,
        ]);
    }

    public function testHomepageShowsFeaturedProducts(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1');
        $this->assertSelectorExists('.featured-title');
    }
}
