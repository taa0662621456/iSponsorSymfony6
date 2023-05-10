<?php

namespace App\Entity\Coupon;

use App\Entity\ObjectSuperEntity;
use App\Entity\ObjectBaseTrait;
use App\Interface\Coupon\CouponInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Coupon\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'coupon')]
#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Coupon extends ObjectSuperEntity implements ObjectInterface, CouponInterface
{

    /** @var string|null */
    protected ?string $couponCode;

    /** @var int|null */
    protected ?int $couponUsageLimit;

    /** @var \DateTimeInterface|null */
    protected ?\DateTimeInterface $couponExpiresAt;

}
