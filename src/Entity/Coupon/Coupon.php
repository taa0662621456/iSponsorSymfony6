<?php

namespace App\Entity\Coupon;

use App\Entity\BaseTrait;

class Coupon
{
    use BaseTrait;

    /** @var string|null */
    protected ?string $couponCode;

    /** @var int|null */
    protected ?int $couponUsageLimit;

    /** @var \DateTimeInterface|null */
    protected ?\DateTimeInterface $couponExpiresAt;

}
