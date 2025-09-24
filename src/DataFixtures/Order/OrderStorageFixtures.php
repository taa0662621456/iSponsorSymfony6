<?php

namespace App\DataFixtures\Order;


use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Category\CategoryCategoryFixture;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class OrderStorageFixtures extends DataFixtures
{
    /**
     * @param ObjectManager $manager
     * @param array|null $property
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'firstTitle' => 'NA',
            'lastTitle' => 'NA',
        ];

        try {
            parent::load($manager, $property);
        } catch (ClientExceptionInterface|TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface $e) {
        }
    }

    public function getDependencies(): array
    {
        return [

/*            VendorMediaFixture::class,
            VendorDocumentFixture::class,
            VendorSecurityFixture::class,
            VendorIbanFixture::class,
            VendorEnGbFixture::class,
            VendorFixture::class,

            CategoryAttachmentFixture::class,
            CategoryEnGbFixture::class,
            CategoryCategoryFixture::class,
            CategoryFixture::class,

            ProjectAttachmentFixture::class,
            ProjectReviewFixture::class,
            ProjectTagFixture::class,
            ProjectTypeFixture::class,
            ProjectEnGbFixture::class,
            ProjectPlatformRewardFixture::class,
            ProjectFixture::class,

            ProductAttachmentFixture::class,
            ProductReviewFixture::class,
            ProductTagFixture::class,
            ProductTypeFixture::class,
            ProductEnGbFixture::class,
            ProductFixture::class,*/

            OrderStatusFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 25;
    }
}