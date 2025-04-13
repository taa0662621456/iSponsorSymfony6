<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;

class EntityName
{
    public function buildEntityName(ObjectProps $props): string
    {
        return ucfirst($props->entity) . ($props->subEntity ? ucfirst($props->subEntity) : '');
    }

}
