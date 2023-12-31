<?php

namespace App\Entity\Coupon;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Coupon\CouponInterface;

#[ORM\Entity]
class Coupon extends RootEntity implements ObjectInterface, CouponInterface
{
    protected ?string $couponCode;

    protected ?int $couponUsageLimit;

    protected ?\DateTimeInterface $couponExpiresAt;
}
