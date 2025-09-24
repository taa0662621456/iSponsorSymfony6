<?php
namespace App\DataFixtures;

use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class PromotionFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $coupon = $this->getReference('coupon_welcome10');

        $promo = new Promotion();
        $promo->setName('Welcome Promotion');
        $promo->setDiscount(15);
        $promo->setCoupon($coupon);

        $manager->persist($promo);
        $this->addReference('promotion_welcome', $promo);

        $manager->flush();
    }

    public static function getGroup(): string { return 'promo'; }
    public static function getPriority(): int { return 20; } // after coupons
}
