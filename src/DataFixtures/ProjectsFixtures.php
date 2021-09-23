<?php

namespace App\DataFixtures;

use App\Entity\Category\Categories;
use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsAttachments;
use App\Entity\Project\ProjectsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\Uid\Uuid;

class ProjectsFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
		$categoriesRepository = $manager->getRepository(Categories::class);

		$categories = $categoriesRepository->findAll();

		for ($p = 1; $p <= 26; $p++) {

			$projects = new Projects();
			$projectEnGb = new ProjectsEnGb();
			$projectAttachments = new ProjectsAttachments();
            $slug = $uuid = Uuid::v4();

			try {
				$projects->setUuid($uuid);
				$projects->setSlug($slug);
            } catch (Exception $e) {
                throw ($e);
            }


            $projects->setProjectCategory($categories[array_rand($categories)]);
            $projects->setProjectType(rand(1, 4));

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
			CategoriesFixtures::class,
		);
	}

	/**
	 * @return int
	 */
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
