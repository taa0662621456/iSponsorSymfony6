<?php

namespace App\DataFixtures;

use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsAttachments;
use App\Entity\Project\ProjectsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
    	for ($p=1; $p <= 26; $p++) {

			$projects = new Projects();
			$projectEnGb = new ProjectsEnGb();
			$projectAttachments = new ProjectsAttachments();

			$projects->setOrdering($p);
			$projects->setCreatedBy(0);
			$projectEnGb->setProjectSlug('p' . $p);
			$projectAttachments->setFile('cover.jpg');
			$projectAttachments->setFilePath('/');

			$manager->persist($projects);
			$manager->persist($projectEnGb);
			$manager->persist($projectAttachments);
			$manager->flush();

		}
    }


	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['projects'];
	}
}
