<?php

namespace App\Entity\Coupon;

use App\Entity\ObjectBaseTrait;

class Coupon
{
    use ObjectBaseTrait;

    /** @var string|null */
    protected ?string $couponCode;

    /** @var int|null */
    protected ?int $couponUsageLimit;

    /** @var \DateTimeInterface|null */
    protected ?\DateTimeInterface $couponExpiresAt;

}
