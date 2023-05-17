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
        // Здесь можно добавить дополнительную логику для настройки купона (например, установка скидки, условий использования и т.д.)

        $this->couponRepository->add($coupon);

        return $code;
    }

    private function generateUniqueCode(): string
    {
        // Генерация уникального кода купона
        // Здесь можно использовать любой механизм генерации кода в соответствии с требованиями проекта

        // В данном примере используется простая генерация случайного кода из чисел и букв
        return substr(md5(uniqid()), 0, 8);
    }


}
