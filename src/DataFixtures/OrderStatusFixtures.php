<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $orderStatusMap = [
            'New' => 'N',
            'Depend' => 'D',
            'Canceled' => 'C',
            'Shipped' => 'S',
            'Delivered' => 'D',
            'Pause' => 'P'
        ];

        for ($i = 0; $i <= count($orderStatusMap); $i++) {

            $orderStatus = new OrderStatus();

            $orderStatus->setOrderStatusCode($i);
            $orderStatus->setOrderStatusName($orderStatusMap[$i]);
            $orderStatus->setOrdering($i);

            $manager->persist($orderStatus);

            $this->setReference('orderStatus_' . $i, $orderStatus);

        }
        $manager->flush();

    }

    public function getDependencies(): array
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
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
            #
            ProductAttachmentFixtures::class,
            ProductReviewFixtures::class,
            ProductTagFixtures::class,
            ProductTypeFixtures::class,
            ProductEnGbFixtures::class,
            ProductFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 24;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['order'];
    }
}
