<?php



namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

class ObjectDefaultRepository extends EntityRepository
{
    /**
     * @throws ToolsException
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
     * @throws ToolsException
     */
    public function createObjectTableByEntity(string $entityName)
    {
        $schemaTool = new SchemaTool($this->getEntityManager());
        $schemaTool->createSchema(
            [$this->getEntityManager()->getClassMetadata($entityName)]
        );
    }
}
