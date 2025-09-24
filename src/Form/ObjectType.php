<?php

namespace App\Form;

use ReflectionClass;
use Symfony\Component\Form\AbstractType;

class ObjectType extends AbstractType
{
    public function getBlockPrefix(): string
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }
}