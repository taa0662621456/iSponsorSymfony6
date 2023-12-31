<?php

namespace App\DataFixtures\Association;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;

final class AssociationProjectTypeFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        parent::load($manager, $property);
    }
}
