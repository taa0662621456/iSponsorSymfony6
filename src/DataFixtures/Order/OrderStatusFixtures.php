<?php

namespace App\DataFixtures\Order;

use Faker\Factory;

use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

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
