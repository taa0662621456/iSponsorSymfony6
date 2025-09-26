<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DashboardControllerTest extends WebTestCase
{
    public function testDashboardRequiresLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/dashboard');
        $this->assertResponseRedirects('/login');
    }
}
