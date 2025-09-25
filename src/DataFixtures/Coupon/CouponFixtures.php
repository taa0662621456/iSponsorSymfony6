<?php

namespace App\DataFixtures\Coupon;

use App\Entity\Coupon\Coupon;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CouponFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $coupon = new Coupon();
        $coupon->setCode('WELCOME10');
        $coupon->setDiscount(10);

        $manager->persist($coupon);
        $this->addReference('coupon_welcome10', $coupon);

        $manager->flush();
    }

    public static function getGroup(): string { return 'promo'; }
    public static function getPriority(): int { return 10; }
}
