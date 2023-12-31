<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\RepositoryInterface\EntityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class EntityRepository extends ServiceEntityRepository implements EntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        $entityClass = $this->getEntityClass();

        parent::__construct($registry, $entityClass);
    }

    protected function getEntityClass(): string
    {
        $reflectionClass = new \ReflectionClass($this);
        $namespace = $reflectionClass->getNamespaceName();
        $className = $reflectionClass->getShortName();

        $entityName = str_replace('Repository', '', $className);

        return $namespace . '\\' . $className;
    }
}
