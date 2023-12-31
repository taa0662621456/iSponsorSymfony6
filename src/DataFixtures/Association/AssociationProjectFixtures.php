<?php

namespace App\DataFixtures\Association;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;

final class AssociationProjectFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        // TODO: Implement load() method.
        parent::load($manager, $property, $n);
    }
}
