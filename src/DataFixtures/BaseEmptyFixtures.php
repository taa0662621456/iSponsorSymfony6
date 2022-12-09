<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class BaseEmptyFixtures extends Fixture
{
    public const EMPTY_FIXTURE = 'emptyFixture';
    public const TOTAL_PROJECTS = 20;
    public const TOTAL_VENDORS = 20;
    public const TOTAL_PRODUCTS = 20;
    public const TOTAL_CATEGORIES = 20;
    public const TOTAL_REVIEWS = 20;

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $emptyFixture = [];

        $this->addReference(self::EMPTY_FIXTURE, (object)$emptyFixture);
    }

    public function getOrder(): int
    {
        return 1;
    }

}

