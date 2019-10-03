<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Category\Categories;
use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsAttachments;
use App\Entity\Project\ProjectsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class ProjectsFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
		$categoriesRepository = $manager->getRepository(Categories::class);

		$categories = $categoriesRepository->findAll();

		for ($p = 1; $p <= 26; $p++) {

			$projects = new Projects();
			$projectEnGb = new ProjectsEnGb();
			$projectAttachments = new ProjectsAttachments();
			$slug = new UuidEncoder();

			try {
				$uuid = Uuid::uuid4();
				$projects->setUuid($uuid);
				$projects->setSlug($slug->encode($uuid));
			} catch (Exception $e) {
			}


			$projects->setProjectCategory($categories[array_rand($categories)]);
			$projects->setProjectType(rand(1, 4));
			$projects->setProjectEnGb($projectEnGb);

			$projectEnGb->setProjectTitle('Project #' . $p);

			$projectAttachments->setFile('cover.jpg');
			$projectAttachments->setFilePath('/');
			$projectAttachments->setProjectAttachments($projects);

			$manager->persist($projectAttachments);
			$manager->persist($projectEnGb);
			$manager->persist($projects);
			$manager->flush();

		}
	}

	public function getDependencies ()
	{
		return array (
			CategoriesFixtures::class,
		);
	}

	/**
	 * @return int
	 */
	public function getOrder()
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
