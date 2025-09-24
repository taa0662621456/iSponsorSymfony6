<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class RepositoryMetadataManagerListener implements EventSubscriber
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs):void
    {
        $classMetadata = $eventArgs->getClassMetadata();

        // Проверяем, что это не MappedSuperclass и нет уже назначенного репозитория
        if (!$classMetadata->isMappedSuperclass && $classMetadata->customRepositoryClassName === null) {
            $entityClass = $classMetadata->getName();
            $repositoryClass = $this->getRepositoryClassForEntity($entityClass);

            if (class_exists($repositoryClass)) {
                $classMetadata->setCustomRepositoryClass($repositoryClass);
            }
        }
    }

    private function getRepositoryClassForEntity(string $entityClass): string
    {
        $entityNamespace = 'App\\Entity\\';
        $repositoryNamespace = 'App\\Repository\\';

        // Удаляем базовое пространство имен сущности и заменяем его на пространство имен репозитория
        $relativeEntityClass = str_replace($entityNamespace, '', $entityClass);
        return $repositoryNamespace . $relativeEntityClass . 'Repository';
    }

    public function getSubscribedEvents():array
    {
        return [
            'loadClassMetadata' => 'loadClassMetadata'
        ];

    }
}