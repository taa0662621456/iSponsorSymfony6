<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase {
    public function testDashboardSnapshot() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/dashboard');
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Active Vendors', $client->getResponse()->getContent());
        $this->assertStringContainsString('Projects', $client->getResponse()->getContent());
        $this->assertStringContainsString('Customers', $client->getResponse()->getContent());
    }
}