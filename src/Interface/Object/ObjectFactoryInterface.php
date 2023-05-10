<?php

namespace App\Interface\Object;

interface ObjectFactoryInterface
{
    public function create(string $className, array $options = []): object;
}
