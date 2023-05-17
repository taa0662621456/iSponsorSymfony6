<?php

namespace App\DataFixtureAttribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class FixtureOrder
{
    public function __construct(public int $order)
    {
    }

}
