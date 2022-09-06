<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Product\ProductAttachment;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Project\ProjectEnGb;
use App\Entity\Project\ProjectTag;
use App\Entity\Project\ProjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use JetBrains\PhpStorm\NoReturn;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{

    #[NoReturn]
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {

            $project = new Project();
            $projectType = $this->getReference('projectType_' . $i);
            $projectEnGb = $this->getReference('projectEnGb_' . $i);
            $projectAttachment = $this->getReference('projectAttachment_' . $i);
            $projectCategory = $this->getReference('category_' . $i);
            $projectTag = $this->getReference('projectTag_' . $i);
//            $projectPlatformReward = $this->getReference('projectPlatformReward_' . $i);
            $projectReview = $this->getReference('projectReview_' . $i);
            #
            $project->setFirstTitle($faker->realText());
            $project->setLastTitle($faker->realText(7000));
            #
            #
            $project->setProjectType($projectType);
            $project->setProjectEnGb($projectEnGb);
            $project->setProjectFeatured(1);
            $project->setProjectCategory($projectCategory);
            #
            $project->addProjectAttachment($projectAttachment);
            $project->addProjectTag($projectTag);
            $project->addProjectFavorite(1);
//            $project->addProjectPlatformReward($projectPlatformReward);
            $project->addProjectReviw($projectReview);

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
            CategoriesCategoryFixtures::class,
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
		return 17;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
