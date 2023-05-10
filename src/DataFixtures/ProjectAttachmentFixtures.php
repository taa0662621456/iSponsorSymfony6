<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ProjectAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 7; ++$i) {
            $projectAttachment = new ProjectAttachment();

            $projectAttachment->setFirstTitle('some file');

            $manager->persist($projectAttachment);

            $this->addReference('projectAttachment_'.$i, $projectAttachment);
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
        ];
    }

    public function getOrder(): int
    {
        return 12;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['project'];
    }
}
