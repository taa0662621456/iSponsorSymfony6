<?php

namespace App\Repository;

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use App\RepositoryInterface\Object\ObjectDefaultRepositoryInterface;

class ObjectDefaultRepository extends EntityRepository implements ObjectDefaultRepositoryInterface
{
    /**
     * @throws ToolsException
     */
    public function createTable(): void
    {
        $schemaTool = new SchemaTool($this->getEntityManager());
        $schemaTool->createSchema(
            [$this->getClassMetadata()]
        );
    }

    /**
     * @param string $entityName Your entity full name like YourEntity::class
     *
     * @throws ToolsException
     */
    public function createObjectTableByEntity(string $entityName): void
    {
        $schemaTool = new SchemaTool($this->getEntityManager());
        $schemaTool->createSchema(
            [$this->getEntityManager()->getClassMetadata($entityName)]
        );
    }
}
