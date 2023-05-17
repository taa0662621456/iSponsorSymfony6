<?php

namespace App\DataFixtures\Association;


use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\NoReturn;


use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\Product\ProductTypeFixtures;


final class AssociationProductFixtures extends DataFixtures
{


    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        // TODO: Implement load() method.
        parent::load($manager, $property, $n);
    }
}
