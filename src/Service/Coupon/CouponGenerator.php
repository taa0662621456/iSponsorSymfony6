<?php

namespace App\Service\Coupon;

use App\EntityInterface\Coupon\CouponGeneratorInterface;
use App\RepositoryInterface\Coupon\CouponRepositoryInterface;

class CouponGenerator implements CouponGeneratorInterface
{
    private CouponRepositoryInterface $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function generateCouponCode(): string
    {
        $code = $this->generateUniqueCode();

        $coupon = $this->couponRepository->createNew();
        $coupon->setCode($code);

        $this->couponRepository->add($coupon);

        return $code;
    }

    private function generateUniqueCode(): string
    {
        return substr(md5(uniqid()), 0, 8);
    }
}
