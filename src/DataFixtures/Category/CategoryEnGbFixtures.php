<?php

namespace App\DataFixtures\Category;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class CategoryEnGbFixtures extends DataFixtures
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $this->titleFixtureEngine('data/CategoryDataFixtures/CategoryDataFixtures.json');


        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 9;
    }
}
