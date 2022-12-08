<?php

namespace App\Factory;

use Webmozart\Assert\Assert;

final class PromotionCouponFactory implements PromotionCouponFactoryInterface
{
    public function __construct(private FactoryInterface $factory)
    {
    }

    public function createNew(): PromotionCouponInterface
    {
        return $this->factory->createNew();
    }

    public function createForPromotion(PromotionInterface $promotion): PromotionCouponInterface
    {
        Assert::true(
            $promotion->isCouponBased(),
            sprintf('Promotion with name %s is not coupon based.', $promotion->getName()),
        );

        /** @var PromotionCouponInterface $coupon */
        $coupon = $this->factory->createNew();
        $coupon->setPromotion($promotion);

        return $coupon;
    }
}
