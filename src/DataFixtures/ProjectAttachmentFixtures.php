<?php

namespace App\DataFixtures;

use App\Entity\Project\Project;
use App\Entity\Project\ProductAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECT_ATTACHMENT_COLLECTION = 'projectAttachmentCollection';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{

        $faker = Factory::create();

        $att = $this->getReference(AttachmentFixtures::ATTACHMENT_COLLECTION);

        $at = array_rand((array)$att);

        $projectAttachmentCollection = new ArrayCollection();
        $projectRepository = $manager->getRepository(Project::class)->findAll();

		for ($p = 1; $p <= 3; $p++) {

            $projectAttachment = new ProductAttachment();
            $project = new Project();


            if ($manager->getRepository(Project::class)->findAll()){

                $project = $projectRepository[array_rand($projectRepository)];
                if (!$projectAttachmentCollection->contains($project)){
                    $projectAttachmentCollection->add($project);
                }
                $project = $projectAttachmentCollection->current();
            }

            $projectAttachmentCollection->add($project);
            $project = $projectAttachmentCollection->current();

//            dump($project);



            $projectAttachment->setFirstTitle('some file');

//            $projectAttachment->addProjectAttachment($project);

            $manager->persist($projectAttachment);
            $manager->flush();
		}

        $this->addReference(self::PROJECT_ATTACHMENT_COLLECTION, $projectAttachmentCollection);
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
