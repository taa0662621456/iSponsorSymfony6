<?php

namespace App\DataFixtures\Project;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class ProjectEnGbFixtures extends DataFixtures
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $this->titleFixtureEngine('data/ProjectDataFixtures/ProjectCharityDataFixtures.json');
        $this->titleFixtureEngine('data/ProjectDataFixtures/ProjectSocialDataFixtures.json');
        $this->titleFixtureEngine('data/ProjectDataFixtures/ProjectBusinessDataFixtures.json');

        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 16;
    }
}
