<?php

namespace App\ServiceInterface\Order;

use App\Entity\Order\OrderStorage;

interface OrderPaymentMethodSelectionRequirementCheckerServiceInterface
{
    public function checkOrderPaymentMethodSelection(OrderStorage $order): bool;
}
