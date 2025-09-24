<?php

namespace App\DataTransferObject;


use Symfony\Component\HttpFoundation\Request;

class ObjectProps extends Request
{
    public function __construct(
        public string $entity,
        public ?string $subEntity = null,
        public ?string $action = null,
    ) {}

}