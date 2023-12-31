<?php

namespace App\DataFixtures\Association;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;

final class AssociationProjectFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        // TODO: Implement load() method.
        parent::load($manager, $property);
    }
}
