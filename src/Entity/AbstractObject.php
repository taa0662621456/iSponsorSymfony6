<?php

namespace App\Entity;


abstract class AbstractObject
{
    use BaseTrait;

    public static function createObject(): static
    {
        return new static ();
    }
}