<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;

final class EntityNamingNamespacing
{
    public function getEntityClassName(ObjectProps $props): string
    {
        $entity = ucfirst($props->entity);
        $subEntity = $props->subEntity ? ucfirst($props->subEntity) : '';

        return $entity . $subEntity;
    }

    public function getEntityClassNamespace(ObjectProps $props, string $baseNamespace = 'App\\Entity'): string
    {
        return $baseNamespace . '\\' . $this->getEntityClassName($props);
    }

    public function getEntityRepositoryNamespace(ObjectProps $props, string $baseNamespace = 'App\\Repository'): string
    {
        return $baseNamespace . '\\' . $this->getEntityClassName($props) . 'Repository';
    }

    public function getEntityTypeNamespace(ObjectProps $props, string $baseNamespace = 'App\\Form'): string
    {
        return $baseNamespace . '\\' . $this->getEntityClassName($props) . 'Type';
    }
}
