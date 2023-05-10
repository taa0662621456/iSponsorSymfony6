<?php

namespace App\Interface\Promotion;

interface PromotionCouponInterface
{

    public function setCode(mixed $code);

    public function setPerCustomerUsageLimit(mixed $per_customer_usage_limit);

    public function setReusableFromCancelledOrders(mixed $reusable_from_cancelled_orders);

    public function setUsageLimit(mixed $usage_limit);

    public function setExpiresAt(\DateTime $param);
}
