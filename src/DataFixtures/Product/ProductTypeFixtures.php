<?php

namespace App\DataFixtures\Product;



use App\DataFixtures\Category\CategoryAttachmentFixtures;
use App\DataFixtures\Category\CategoryCategoryFixture;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Project\ProjectEnGbFixtures;
use App\DataFixtures\Project\ProjectPlatformRewardFixtures;
use App\DataFixtures\Project\ProjectReviewFixtures;
use App\DataFixtures\Project\ProjectTagFixtures;
use App\DataFixtures\Project\ProjectTypeFixtures;
use App\DataFixtures\Vendor\VendorDocumentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Vendor\VendorMediaFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


final class ProductTypeFixtures extends DataFixtures
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
        ];

        parent::load($manager, $property, $n);
    }

	public function getOrder(): int
    {
		return 21;
	}

}
