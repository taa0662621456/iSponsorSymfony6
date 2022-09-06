<?php

namespace App\DataFixtures;

use App\Entity\Project\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ProjectTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECT_TYPE = 'projectType';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $projectTypeTitle = [
            'charity',
            'social',
            'business',
            'donate'
        ];

        $projectTypeCollection = new ArrayCollection();



		for ($p = 0; $p <= 3; $p++) {

            $projectType = new Type();


            $projectType->setFirstTitle($projectTypeTitle[$p]);
            $projectType->setMiddleTitle($projectTypeTitle[$p]);
            $projectType->setLastTitle($projectTypeTitle[$p]);

            $manager->persist($projectType);
            $manager->flush();

            $projectTypeCollection->add($projectType);
		}

        $this->addReference(self::PROJECT_TYPE, $projectTypeCollection);
	}

	public function getDependencies (): array
    {
		return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
            ReviewProductFixtures::class,
            CategoryAttachmentFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 7;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
