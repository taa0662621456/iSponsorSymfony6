<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ProjectTypeFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{

		for ($p = 1; $p <= 26; $p++) {

            $projectType = new ProjectType();

            //$projectType->setProjectType($projectType[array_rand($projectRepository)]);

            $projectType->setFirstTitle('ProjectFT #_' . $p);
            $projectType->setMiddleTitle('ProjectMT #_' . $p);
            $projectType->setLastTitle('ProjectLT #_' . $p);

            $manager->persist($projectType);
//            dd($projectType);
            $manager->flush();
		}
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
		return 6;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
