<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;
use Symfony\Component\HttpFoundation\Request;

final class EntityNamingRequestParametersParser
{
    public function buildEntityNamingFromRequest(Request $request): ObjectProps
    {
        $entity = $request->attributes->get('entity');
        $subEntity = $request->attributes->get('subEntity');
        $routeName = $request->attributes->get('_route');

        $action = null;
        if ($routeName && str_contains($routeName, '_')) {
            $parts = explode('_', $routeName);
            $action = strtolower(end($parts));
        }

        return new ObjectProps(
            entity: $entity ?? '',
            subEntity: $subEntity ? ucfirst($subEntity) : null,
            action: $action
        );
    }
}