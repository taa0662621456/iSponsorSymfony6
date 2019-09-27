<?php

namespace App\DataFixtures;

use App\Entity\Category\Categories;
use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsAttachments;
use App\Entity\Project\ProjectsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture implements DependentFixtureInterface
//class ProjectsFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
		$categoriesRepository = $manager->getRepository(Categories::class);

		$categories = $categoriesRepository->findAll();

		for ($p=1; $p <= 26; $p++) {

			$projects = new Projects();
			$projectEnGb = new ProjectsEnGb();
			$projectAttachments = new ProjectsAttachments();

			$projects->setProjectCategory($categories[array_rand($categories)]);
			$projects->setProjectType(rand(1, 4));
			$projects->setSlug('slug' . $p);
			$projectEnGb->setProjectTitle('Project #' . $p);
			$projectAttachments->setFile('cover.jpg');
			$projectAttachments->setFilePath('/');

			$manager->persist($projects);
			$manager->persist($projectEnGb);
			$manager->persist($projectAttachments);
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
