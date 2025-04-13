<?php

namespace App\Service\Entity;

use Doctrine\Persistence\ManagerRegistry;

class EntityRepository
{
    private const FALLBACK_OBJECT = 'Root';

    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly string $repositoryNamespace) {}

    public function getRepositoryNamespace(string $objectName): ?string
    {
        return $this->repositoryNamespace . '\\' . $objectName . 'Repository';
    }

    public function getRepository(string $className): ?object
    {
        return $this->managerRegistry->getRepository($className);
    }

}
