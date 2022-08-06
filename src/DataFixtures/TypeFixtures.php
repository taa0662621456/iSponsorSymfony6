<?php

namespace App\DataFixtures;

use App\Entity\Type\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{

		for ($p = 1; $p <= 5; $p++) {

			$type = new Type();

            $type->setMiddleTitle('Type #_' . $p);
            $type->setLastTitle('Type #_' . $p);
            $manager->persist($type);
            $manager->flush();

		}
	}

	public function getDependencies (): array
    {
		return [
			CategoryFixtures::class,
			CategoriesCategoryFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 5;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['type'];
	}
}
