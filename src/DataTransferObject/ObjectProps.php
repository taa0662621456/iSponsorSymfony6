<?php

namespace App\DataTransferObject;

use Symfony\Component\HttpFoundation\Request;

class ObjectProps
{
    public function __construct(
        public string $entity,
        public ?string $subEntity,
        public string $crudAction,
    ) {}

}
