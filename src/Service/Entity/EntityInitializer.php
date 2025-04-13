<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;

class EntityInitializer
{
    public function initializeObject(string $entity, ?string $subEntity = null, ?string $crudAction = 'index'): ObjectProps
    {
        if (!$entity) {
            throw new \InvalidArgumentException('Entity name is required for initialization.');
        }

        return new ObjectProps(
            entity: $entity,
            subEntity: $subEntity,
            crudAction: $crudAction
        );
    }

}
