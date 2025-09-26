<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testIndexLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/category');
        $this->assertResponseIsSuccessful();
    }

    public function testShowCategory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/category/1'); // фикстуры должны быть загружены
        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorExists('.category-name');
    }
}
