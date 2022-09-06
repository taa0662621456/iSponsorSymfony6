<?php
declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Project\Project;
use App\Entity\Project\ProjectTag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class ProjectTagFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECT_TAG_COLLECTION = 'projectTagCollection';

    /**
     * @throws Exception
     */
    #[NoReturn]
    public function load(ObjectManager $manager)
	{
        $projectTagTitle = [
            'charity',
            'donate',
            'business',
            'social',
            'media',
            'park',
            'square',
            'city',
            'state',
            'national',
            'district',
        ];

        $projectTagCollection = new ArrayCollection();
        $projectCollection = new ArrayCollection();
//        $projectTagRepository = $manager->getRepository(ProjectType::class)->findAll();
//        $projectRepository = $manager->getRepository(Project::class)->findAll();


        for ($p = 0; $p <= count($projectTagTitle); $p++) {

            $projectTag = new ProjectTag();
            $project = new Project();

            if ($manager->getRepository(ProjectTag::class)->findAll()){

                $projectTagRepository = $manager->getRepository(ProjectTag::class)->findAll();

                foreach ($projectTagRepository as $item){
                        $projectTagCollection->add($item);
                }

//                $tag = $projectTagCollection[array_rand($projectTagRepository)];
            }

            if ($manager->getRepository(Project::class)->findAll()) {
                $projectRepository = $manager->getRepository(Project::class)->findAll();

                foreach ($projectRepository as $item) {
                    $projectCollection->add($item);
                }

                $project = $projectRepository[array_rand($projectRepository)];
                //$projectTag->addProjectTag($project);
            }

            #
            $projectTag->setFirstTitle($projectTagTitle[$p]);
            #
            $manager->persist($projectTag);
            $manager->flush();

		}

        $this->addReference(self::PROJECT_TAG_COLLECTION, $projectTagCollection);
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
		return 8;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
