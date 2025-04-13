<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;

class EntityType
{
    public function EntityType(ObjectProps $props): string
    {
        return ucfirst($props->entity) . ($props->subEntity ? ucfirst($props->subEntity) : '');
    }

}
