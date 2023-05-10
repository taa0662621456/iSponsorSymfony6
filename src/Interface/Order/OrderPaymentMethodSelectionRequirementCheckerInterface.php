<?php

namespace App\Interface\Order;

use App\Entity\Order\OrderStorage;

interface OrderPaymentMethodSelectionRequirementCheckerInterface
{
    public function checkOrderPaymentMethodSelection(OrderStorage $order): bool;
}
