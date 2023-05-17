<?php

namespace App\Service\Order;

use App\Entity\Order\OrderStorage;
use App\ServiceInterface\Order\OrderPaymentMethodSelectionRequirementCheckerServiceInterface;

class OrderPaymentMethodSelectionRequirementCheckerService implements OrderPaymentMethodSelectionRequirementCheckerServiceInterface
{
    public function checkOrderPaymentMethodSelection(OrderStorage $order): bool
    {
        // TODO: Implement checkOrderPaymentMethodSelection() method.
        return true;
    }
}
