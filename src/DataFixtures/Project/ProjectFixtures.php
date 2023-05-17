<?php

namespace App\DataFixtures\Project;



use App\DataFixtures\Category\CategoryAttachmentFixtures;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Vendor\VendorDocumentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Vendor\VendorMediaFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;
use App\Entity\Project\Project;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ProjectFixtures extends DataFixtures
{


    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
            'projectType' => $this->getReference('ProjectTypeFixtures_'.$i),
            'projectEnGb' => $this->getReference('ProjectEnGbFixtures_'.$i),
            'projectAttachment' => $this->getReference('ProjectAttachmentFixtures_'.$i),
            'projectCategory' => $this->getReference('CategoryFixtures_'.$i),
            'projectTag' => $this->getReference('ProjectTagFixtures_'.$i),
            'projectReview' => $this->getReference('ProjectReviewFixtures_'.$i),
        ];

        parent::load($manager, $property, $n);
    }

    public function getOrder(): int
    {
        return 16;
    }

}
