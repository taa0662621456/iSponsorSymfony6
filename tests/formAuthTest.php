<?php

use App\Repository\Vendor\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class formAuthTest extends WebTestCase
{
    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(VendorRepository::class);

        // извлечь тестового пользователя
        $testUser = $userRepository->findOneByEmail('john.doe@example.com');

        // симулировать вход $testUser в систему
        $client->loginUser($testUser);

        // тестировать, например, страницу профиля
        $client->request('GET', '/profile');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello John!');
    }
}
