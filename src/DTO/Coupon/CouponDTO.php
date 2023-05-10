<?php

namespace App\DTO\Coupon;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class CouponDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    protected ?string $couponCode;

    protected ?int $couponUsageLimit;

    protected ?\DateTimeInterface $couponExpiresAt;
}
