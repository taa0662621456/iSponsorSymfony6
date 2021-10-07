<?php

namespace App\Entity;


abstract class AbstractObject
{
    public static function createObject(): static
    {
        return new static ();
    }
}