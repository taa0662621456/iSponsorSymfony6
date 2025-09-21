<?php

namespace App\ServiceInterface\Entity;

use App\Service\Entity\EntityRepository;

interface EntityRepositoryInterface
{
    public function getEntityRepositoryNamespace(): string;
    public function getEntityRepositoryClassName(): string;
    public function createEntityRepositoryObject(string $entityRepositoryClassName): ?EntityRepository;
}
