<?php

namespace App\DataFixtureAttribute;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class FixtureDependence
{
    public function __construct(public array $fixtures)
    {
    }

}
