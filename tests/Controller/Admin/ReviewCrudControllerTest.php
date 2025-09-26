<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewCrudControllerTest extends WebTestCase {
    public function testApproveReviewSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?review=300&action=approve');
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Review approved', $client->getResponse()->getContent());
    }
    public function testMarkReviewAsSpamSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?review=300&action=spam');
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Review marked as spam', $client->getResponse()->getContent());
    }
}