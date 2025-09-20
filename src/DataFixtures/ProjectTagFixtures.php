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

        for ($i = 0; $i < count($projectTagTitle); $i++) {

            $projectTag = new ProjectTag();

            $projectTag->setFirstTitle($projectTagTitle[$i]);
            #
            $manager->persist($projectTag);

            $this->addReference('projectTag_' . $i, $projectTag);
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
        ];
	}

	public function getOrder(): int
    {
		return 14;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
