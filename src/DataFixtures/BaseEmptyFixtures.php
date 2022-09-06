<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class BaseEmptyFixtures extends Fixture
{
    public const EMPTY_FIXTURE = 'emptyFixture';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $emptyFixture = [];

        $this->addReference(self::EMPTY_FIXTURE, (object)$emptyFixture);
    }
}

