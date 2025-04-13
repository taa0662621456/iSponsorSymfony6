<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;
use Symfony\Component\HttpFoundation\Request;

class EntityPropertyParser
{
    public function parse(Request $request): ?ObjectProps
    {
        $entity = $request->attributes->get('entity');
        $subEntity = $request->attributes->get('subEntity');
        $crudAction = $request->attributes->get('_route');

        if (!$entity || !$crudAction) {
            return null;
        }

        return new ObjectProps(
            entity: $entity,
            subEntity: $subEntity,
            crudAction: $crudAction
        );
    }

}
