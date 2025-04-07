<?php

namespace App\RepositoryInterface\Coupon;

use App\RepositoryInterface\EntityRepositoryInterface;

interface CouponRepositoryInterface extends EntityRepositoryInterface
{

    public function add($coupon);

    public function createNew();
}
