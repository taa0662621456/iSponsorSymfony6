<?php

namespace App\Entity\Coupon;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Coupon\CouponInterface;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
final class Coupon extends ObjectSuperEntity implements ObjectInterface, CouponInterface
{
    protected ?string $couponCode;

    protected ?int $couponUsageLimit;

    protected ?\DateTimeInterface $couponExpiresAt;
}
