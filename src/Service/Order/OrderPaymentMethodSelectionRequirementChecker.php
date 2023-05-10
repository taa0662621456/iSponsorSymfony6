<?php

namespace App\Service\Order;

use App\Entity\Order\OrderStorage;
use App\Interface\Order\OrderPaymentMethodSelectionRequirementCheckerInterface;

class OrderPaymentMethodSelectionRequirementChecker implements OrderPaymentMethodSelectionRequirementCheckerInterface
{

    public function checkOrderPaymentMethodSelection(OrderStorage $order): bool
    {
        // TODO: Implement checkOrderPaymentMethodSelection() method.
        return true;
    }
}
