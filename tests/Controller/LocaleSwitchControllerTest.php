<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class LocaleSwitchControllerTest extends WebTestCase
{
    public function testLocaleSwitchToFrench(): void
    {
        $client = static::createClient();
        $client->request('GET', '/locale/fr');
        $this->assertResponseRedirects();

        $client->followRedirect();
        $this->assertSelectorExists('html[lang="fr"]');
    }
}
