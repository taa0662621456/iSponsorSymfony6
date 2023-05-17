<?php

namespace App\Service;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Persistence\Mapping\ClassMetadata as ClassMetadataInterface;

class ClassMetadata implements ClassMetadataInterface
{
    private string $name;
    private array $fieldMappings;
    private ClassMetadataInfo $classMetadataInfo;

    public function __construct(array $fieldMappings = [], ?string $name = 'class')
    {
        $this->fieldMappings = $fieldMappings;
        $this->classMetadataInfo = new ClassMetadataInfo($name);
        $this->name = $name;
    }

    public function getName(): string
    {
        try {
            $reflectionClass = new \ReflectionClass($this->name);
            return $reflectionClass->getShortName();
        } catch (\ReflectionException $e) {
            return 'null class name';
        }
    }

    public function getIdentifier(): array
    {
        // Предполагая, что поле идентификатора называется "id"
        return ['id'];
    }

    public function getReflectionClass(): ?\ReflectionClass
    {
        try {
            return new \ReflectionClass($this->name);
        } catch (\ReflectionException $e) {
            return null;
        }
    }

    public function hasField($fieldName): bool
    {
        return isset($this->fieldMappings[$fieldName]);
    }

    public function getFieldNames()
    {
        return array_keys($this->fieldMappings);
    }

    public function getTypeOfField($fieldName)
    {
        if ($this->hasField($fieldName)) {
            return $this->fieldMappings[$fieldName]['type'];
        }

        return null;
    }

    public function isIdentifier(string $fieldName): bool
    {
        // Проверяем, является ли поле идентификатором
        return $fieldName === 'id';
    }

    public function hasAssociation(string $fieldName): bool
    {
        // Проверяем, является ли поле ассоциацией
        return $this->classMetadataInfo->hasAssociation($fieldName);
    }

    public function isSingleValuedAssociation(string $fieldName): bool
    {
        // Проверяем, является ли поле однозначной ассоциацией
        // Вернуть true, если поле является однозначной ассоциацией, в противном случае - false
        // Пример реализации:
        return $this->classMetadataInfo->isSingleValuedAssociation($fieldName);
    }

    public function isCollectionValuedAssociation(string $fieldName): bool
    {
        // Проверяем, является ли поле коллекцией ассоциаций
        // Вернуть true, если поле является коллекцией ассоциаций, в противном случае - false
        // Пример реализации:
        return $this->classMetadataInfo->isCollectionValuedAssociation($fieldName);
    }

    public function getIdentifierFieldNames(): array
    {
        // Возвращаем имена полей идентификатора
        // Пример реализации:
        return $this->classMetadataInfo->getIdentifierFieldNames();
    }

    public function getAssociationNames(): array
    {
        // Возвращаем имена всех ассоциаций
        // Пример реализации:
        return $this->classMetadataInfo->getAssociationNames();
    }

    public function getAssociationTargetClass(string $assocName): ?string
    {
        // Получаем класс, к которому относится ассоциация
        // Вернуть имя класса, к которому относится ассоциация
        // Пример реализации:
        return $this->classMetadataInfo->getAssociationTargetClass($assocName);
    }

    public function isAssociationInverseSide(string $assocName): bool
    {
        // Проверяем, является ли ассоциация обратной стороной
        // Вернуть true, если ассоциация является обратной стороной, в противном случае - false
        // Пример реализации:
        return $this->classMetadataInfo->isAssociationInverseSide($assocName);
    }

    public function getAssociationMappedByTargetField(string $assocName)
    {
        // Получаем имя поля в целевом классе, сопоставленное с ассоциацией
        // Вернуть имя поля в целевом классе, сопоставленное с ассоциацией
        // Пример реализации:
        return $this->classMetadataInfo->getAssociationMappedByTargetField($assocName);
    }

    /**
     * @throws \ReflectionException
     */
    public function getIdentifierValues(object $object): array
    {
        // Получаем значение идентификатора объекта
        $identifierValues = [];

        foreach ($this->getIdentifierFieldNames() as $fieldName) {
            $reflectionProperty = new \ReflectionProperty($object, $fieldName);
            $reflectionProperty->setAccessible(true);
            $identifierValues[$fieldName] = $reflectionProperty->getValue($object);
        }

        return $identifierValues;
    }
}
