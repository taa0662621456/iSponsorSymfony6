<?php

namespace App\DataFixtures\Locale;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class LocaleFixtures extends DataFixtures
{

    public function load(ObjectManager $manager, ?array $property = []): void
    {
        parent::load($manager, $property);
    }
}
