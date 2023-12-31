<?php

namespace App\Exception\Doctrine\DataFixtures;

class FixturesGroupNotFoundException extends \Exception
{
    public function __construct(string $group)
    {
        $message = sprintf('Fixture group "%s" does not exist.', $group);
        parent::__construct($message);
    }
}
