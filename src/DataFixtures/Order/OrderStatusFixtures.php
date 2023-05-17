<?php

namespace App\DataFixtures\Order;



use App\DataFixtures\Category\CategoryAttachmentFixtures;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Product\ProductAttachmentFixtures;
use App\DataFixtures\Product\ProductEnGbFixtures;
use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\Product\ProductReviewFixtures;
use App\DataFixtures\Product\ProductTagFixtures;
use App\DataFixtures\Product\ProductTypeFixtures;
use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Project\ProjectEnGbFixtures;
use App\DataFixtures\Project\ProjectFixtures;
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
use App\Entity\Order\OrderStatus;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class OrderStatusFixtures extends DataFixtures
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

/*    public function getDependencies(): array
    {
        return [
            VendorMediaFixture::class,
            VendorDocumentFixture::class,
            VendorSecurityFixture::class,
            VendorIbanFixture::class,
            VendorEnGbFixture::class,
            VendorFixture::class,
            #
            CategoryAttachmentFixture::class,
            CategoryEnGbFixture::class,
            CategoryCategoryFixture::class,
            CategoryFixture::class,
            #
            ProjectAttachmentFixture::class,
            ProjectReviewFixture::class,
            ProjectTagFixture::class,
            ProjectTypeFixture::class,
            ProjectEnGbFixture::class,
            ProjectFixture::class,
            ProjectPlatformRewardFixture::class,
            #
            ProductAttachmentFixture::class,
            ProductReviewFixture::class,
            ProductTagFixture::class,
            ProductTypeFixture::class,
            ProductEnGbFixture::class,
            ProductFixture::class,
        ];
    }*/

    public function getOrder(): int
    {
        return 24;
    }

}
