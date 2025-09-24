<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectCrudControllerTest extends WebTestCase {
    public function testPublishProjectWithoutRewardFails() {
        $client = static::createClient();
        $client->request('GET', '/admin?project=99&action=publish');
        $this->assertResponseStatusCodeSame(400);
        $this->assertStringContainsString('Project requires reward and tag', $client->getResponse()->getContent());
    }
    public function testFeatureProjectSnapshot() {
        $client = static::createClient();
        $client->request('GET', '/admin?project=100&action=feature');
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Project featured', $client->getResponse()->getContent());
    }
}