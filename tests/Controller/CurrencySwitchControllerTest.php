<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\AcmeFixturesBundle\Services\FixturesTrait;

final class CurrencySwitchControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function testCurrencySwitchChangesPrices(): void
    {
        $client = static::createClient();
        $client->request('GET', '/currency/USD');
        $this->assertResponseRedirects();

        $client->followRedirect();
        $this->assertSelectorTextContains('.price', '$');
    }
}
