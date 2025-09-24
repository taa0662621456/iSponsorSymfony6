<?php

namespace App\ServiceInterface\Entity;

interface EntityTypeInterface
{
    public function getEntityTypeNamespace(): string;
    public function getEntityTypeClassName(): string;
    public function createEntityTypeObject(): object;

}