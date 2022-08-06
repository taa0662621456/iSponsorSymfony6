<?php

namespace App\DataFixtures;

use App\Entity\Project\Project;
use App\Entity\Project\ProjectAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectAttachmentFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $projectCollection = new ArrayCollection();
        $projectRepository = $manager->getRepository(Project::class)->findAll();

		for ($p = 1; $p <= 3; $p++) {

            $projectAttachment = new ProjectAttachment();
            $project = new Project();


            if ($manager->getRepository(Project::class)->findAll()){

                $project = $projectRepository[array_rand($projectRepository)];
                if (!$projectCollection->contains($project)){
                    $projectCollection->add($project);
                }
                $project = $projectCollection->current();
            }

            $projectCollection->add($project);
            $project = $projectCollection->current();

//            dump($project);



            $projectAttachment->setFileName('cover.jpg');
            $projectAttachment->setFilePath('/');
            $projectAttachment->setFileLayoutPosition('homepage');
//            $projectAttachment->addProjectAttachment($project);

            $manager->persist($projectAttachment);
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
            ProjectTypeFixtures::class,

        ];
    }

	public function getOrder(): int
    {
		return 7;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
