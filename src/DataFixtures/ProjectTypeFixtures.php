<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectTypeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
	{
        $projectTypeTitle = [
            'charity',
            'social',
            'business',
            'donate'
        ];

		for ($i = 0; $i < count($projectTypeTitle); $i++) {

            $projectType = new ProjectType();


            $projectType->setFirstTitle($projectTypeTitle[$i]);
            $projectType->setMiddleTitle($projectTypeTitle[$i]);
            $projectType->setLastTitle($projectTypeTitle[$i]);

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
