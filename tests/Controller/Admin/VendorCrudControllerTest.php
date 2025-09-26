<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VendorCrudControllerTest extends WebTestCase {
    public function testApproveVendorSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?vendor=1&action=approve');
        $this->assertResponseStatusCodeSame(200);
        $this->assertStringContainsString('Vendor approved', $client->getResponse()->getContent());
    }
    public function testSuspendVendorSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?vendor=1&action=suspend');
        $this->assertResponseStatusCodeSame(200);
        $this->assertStringContainsString('Vendor suspended', $client->getResponse()->getContent());
    }
}