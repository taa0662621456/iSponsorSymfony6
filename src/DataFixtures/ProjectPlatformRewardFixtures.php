<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectPlatformReward;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use JetBrains\PhpStorm\NoReturn;

final class ProjectPlatformRewardFixtures extends AbstractDataFixture implements DependentFixtureInterface
{
    #[NoReturn]
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 6; ++$i) {
            $projectPlatformReward = new ProjectPlatformReward();

            $project = $this->getReference('project_'.$i);

            $projectPlatformReward->setCommissionStartTime($faker->date());
            $projectPlatformReward->setCommissionEndTime($faker->date());

            $manager->persist($projectPlatformReward);

            $this->addReference('projectPlatformReward_'.$i, $projectPlatformReward);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,

            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,

            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryCategoryFixtures::class,
            CategoryFixtures::class,

            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
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
