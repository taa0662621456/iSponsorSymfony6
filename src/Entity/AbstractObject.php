<?php

namespace App\Entity;

use JetBrains\PhpStorm\Pure;

abstract class AbstractObject
{
    //use BaseTrait;

    #[Pure] public static function createObject(): static
    {
        return new static ();
    }
}