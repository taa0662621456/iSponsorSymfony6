<?php
declare(strict_types=1);


namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\SchemaTool;

class ObjectDefaultRepository extends EntityRepository
{
    /**
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function createTable()
    {
        $schemaTool = new SchemaTool($this->getEntityManager());
        $schemaTool->createSchema(
            [$this->getClassMetadata()]
        );
    }

    /**
     * @param string $entityName Your entity full name like YourEntity::class
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function createObjectTableByEntity(string $entityName)
    {
        $schemaTool = new SchemaTool($this->getEntityManager());
        $schemaTool->createSchema(
            [$this->getEntityManager()->getClassMetadata($entityName)]
        );
    }
}
