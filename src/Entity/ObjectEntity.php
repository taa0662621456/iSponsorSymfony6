<?php

namespace App\Entity;


abstract class ObjectEntity
{
    use BaseTrait;

    public static function createObject(): static
    {
        return new static ();
    }
}
