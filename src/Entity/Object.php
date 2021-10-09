<?php

namespace App\Entity;


abstract class Object
{
    use BaseTrait;

    public static function createObject(): static
    {
        return new static ();
    }
}