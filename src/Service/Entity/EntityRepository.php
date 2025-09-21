<?php

namespace App\Service\Entity;

use App\ServiceInterface\Entity\EntityRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class EntityRepository implements EntityRepositoryInterface
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly LoggerInterface $logger
    ) {}

    public function createEntityRepositoryObject(string $entityRepositoryClassName): ?EntityRepository
    {
        if (empty($entityRepositoryClassName)) {
            $this->logger->error('Empty class name provided to EntityRepository.');
            return null;
        }

        if (!class_exists($entityRepositoryClassName)) {
            $this->logger->error('Entity class does not exist.', ['class' => $entityRepositoryClassName]);
            return null;
        }

        try {
            $repository = $this->managerRegistry->getRepository($entityRepositoryClassName);

            if (!$repository instanceof EntityRepository) {
                $this->logger->error('Invalid repository type returned.', [
                    'class' => $entityRepositoryClassName,
                    'repository' => get_class($repository),
                ]);
                return null;
            }

            return $repository;
        } catch (\Throwable $e) {
            $this->logger->critical('Failed to create EntityRepository.', [
                'class' => $entityRepositoryClassName,
                'exception' => $e->getMessage(),
            ]);
            return null;
        }
    }

    public function getEntityRepositoryNamespace(): string
    {
        return 'App\\Entity';
    }

    public function getEntityRepositoryClassName(): string
    {
        return EntityRepository::class;
    }
}
