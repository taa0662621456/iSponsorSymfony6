<?php

namespace App\DataFixtures;

use App\Entity\Type\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{
    public const TYPE_COLLECTION = 'typeCollection';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $typeCollection = new ArrayCollection();

		for ($p = 1; $p <= 5; $p++) {

			$type = new Type();

            $type->setMiddleTitle('Type #_' . $p);
            $type->setLastTitle('Type #_' . $p);
            $manager->persist($type);
            $manager->flush();

            $typeCollection->add($type);

        }

        $this->addReference(self::TYPE_COLLECTION, $typeCollection);
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
