<?php

namespace App\DataFixtures\Product;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class ProductFixtures extends DataFixtures
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $this->titleFixtureEngine('data/ProductDataFixtures/ProductDataFixtures.json');

        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 23;
    }

}
