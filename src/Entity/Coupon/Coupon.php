<?php

namespace App\Entity\Coupon;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Coupon\CouponInterface;

#[ORM\Entity]
class Coupon extends RootEntity implements ObjectInterface, CouponInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    protected ?string $couponCode;

    protected ?int $couponUsageLimit;

    protected ?DateTimeInterface $couponExpiresAt;
}
