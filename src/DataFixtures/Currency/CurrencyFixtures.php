<?php

namespace App\DataFixtures\Currency;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CurrencyFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        parent::load($manager, $property);
    }

}
