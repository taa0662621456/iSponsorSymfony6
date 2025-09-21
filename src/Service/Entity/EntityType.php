<?php

namespace App\Service\Entity;

use Symfony\Component\HttpFoundation\Request;

class EntityType
{
    public function getEntityTypeName(Request $request): string
    {
        return ucfirst($request->attributes->get('entity')) . ($request->attributes->get('subEntity') ? ucfirst($request->attributes->get('subEntity')) : '');
    }

    public function getEntityTypeNamespace(Request $request): string
    {
        return ucfirst($request->attributes->get('entity')) . ($request->attributes->get('subEntity') ? ucfirst($request->attributes->get('subEntity')) : '');
    }

    public function createEntityTypeObject(string $entityClassName): object
    {
        if (!class_exists($entityClassName)) {
            throw new \InvalidArgumentException("Attachment class $entityClassName does not exist.");
        }

        return new $entityClassName();
    }

}
