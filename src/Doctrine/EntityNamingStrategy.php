<?php

namespace App\Doctrine;

use Doctrine\ORM\Mapping\NamingStrategy;

class EntityNamingStrategy implements NamingStrategy
{
    public function classToTableName($className): string
    {
        return $this->underscore($this->getShortClassName($className));
    }

    public function propertyToColumnName($propertyName, $className = null): string
    {
        return $this->underscore($propertyName);
    }

    public function embeddedFieldToColumnName($propertyName, $embeddedColumnName, $className = null, $embeddedClassName = null): string
    {
        return $this->underscore($propertyName) . '_' . $embeddedColumnName;
    }

    public function referenceColumnName(): string
    {
        return 'id';
    }

    public function joinColumnName($propertyName): string
    {
        return $this->underscore($propertyName) . '_id';
    }

    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null): string
    {
        return $this->underscore($sourceEntity) . '_' . $this->underscore($targetEntity);
    }

    public function joinKeyColumnName($entityName, $referencedColumnName = null): string
    {
        return $this->underscore($this->getShortClassName($entityName)) . '_id';
    }

    private function getShortClassName($className): bool|string
    {
        $classNameParts = explode('\\', $className);
        return end($classNameParts);
    }

    private function underscore($string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
