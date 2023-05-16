<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ProjectTypeFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $projectTypeMap = [
            'charity',
            'social',
            'business',
            'donate',
            'special',
            'government',
            'private',
        ];
		for ($i = 1; $i <= count($projectTypeMap)-1; $i++) {

            $projectType = new ProjectType();
            #
            $projectType->setFirstTitle($projectTypeMap[$i]);
            $projectType->setMiddleTitle($projectTypeMap[$i]);
            $projectType->setLastTitle($projectTypeMap[$i]);
            #
            $manager->persist($projectType);

            $this->setReference('projectType_' . $i, $projectType);
        }
        $manager->flush();

    }

	public function getDependencies (): array
    {
		return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,
            #
            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 15;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
