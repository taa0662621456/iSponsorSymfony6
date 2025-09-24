<?php

namespace App\ServiceInterface\Entity;

interface EntityRepositoryInterface
{
    public function createEntityRepositoryObject(string $className): object;
    public function getEntityRepositoryNamespace(): string;
}