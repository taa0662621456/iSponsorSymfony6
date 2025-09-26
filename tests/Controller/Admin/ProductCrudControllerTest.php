<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductCrudControllerTest extends WebTestCase {
    public function testInvalidPriceSnapshot() {
        $client = static::createClient();
        $client->request('POST', '/admin?product=200&action=save', ['price' => -5]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertStringContainsString('Invalid price', $client->getResponse()->getContent());
    }
    public function testMarkProductAsFeaturedSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?product=200&action=markFeatured');
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Product marked as featured', $client->getResponse()->getContent());
    }
}