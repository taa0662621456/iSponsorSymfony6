<?php

namespace App\DataFixtures;

use App\Entity\Project\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use JetBrains\PhpStorm\NoReturn;

final class ProjectFixtures extends Fixture implements DependentFixtureInterface
{

    #[NoReturn]
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        for ($i = 1; $i <= 6; $i++) {

            $project = new Project();

            $projectType = $this->getReference('projectType_' . $i);
            $projectEnGb = $this->getReference('projectEnGb_' . $i);
            $projectAttachment = $this->getReference('projectAttachment_' . $i);
            $projectCategory = $this->getReference('category_' . $i);
            $projectTag = $this->getReference('projectTag_' . $i);
            $projectReview = $this->getReference('projectReview_' . $i);
            #
            $project->setFirstTitle($faker->realText());
            $project->setLastTitle($faker->realText(7000));
            #
            $project->setProjectType($projectType);
            $project->setProjectEnGb($projectEnGb);
            $project->setProjectCategory($projectCategory);
            #
            $project->addProjectAttachment($projectAttachment);
            $project->addProjectTag($projectTag);
            $project->addProjectReview($projectReview);

            $manager->persist($project);

            $this->addReference('project_' . $i, $project);
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
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,

        ];
	}

	public function getOrder(): int
    {
		return 16;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
