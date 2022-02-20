<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Project\ProjectEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ProjectsFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
		$categoriesRepository = $manager->getRepository(Category::class);

		$categories = $categoriesRepository->findAll();

		for ($p = 1; $p <= 26; $p++) {

			$projects = new Project();
			$projectEnGb = new ProjectEnGb();
			$projectAttachments = new ProjectAttachment();

            $projects->addProjectCategory($categories[array_rand($categories)]);
            $projects->setProjectType(random_int(1, 4));

            $projects->setProjectEnGb($projectEnGb);

            $projectEnGb->setProjectTitle('Project #' . $p);
            $projectEnGb->setFirstTitle('ProjectFT #' . $p);
            $projectEnGb->setMiddleTitle('ProjectMT #' . $p);
            $projectEnGb->setLastTitle('ProjectLT #' . $p);

            $projectAttachments->setFileName('cover.jpg');
            $projectAttachments->setFilePath('/');

            $projectAttachments->setProjectAttachments($projects);

            $manager->persist($projectAttachments);
            $manager->persist($projectEnGb);
            $manager->persist($projects);
            $manager->flush();

		}
	}

	public function getDependencies (): array
    {
		return array (
			CategoryFixtures::class,
		);
	}

	public function getOrder(): int
    {
		return 3;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['projects'];
	}
}
