<?php

namespace App\Service\Order\OrderPayment;

use App\Entity\Order\OrderStorage;
use App\ServiceInterface\Order\OrderPaymentMethodSelectionRequirementCheckerServiceInterface;

class OrderPaymentMethodChecker implements OrderPaymentMethodSelectionRequirementCheckerServiceInterface
{
    public function checkOrderPaymentMethodSelection(OrderStorage $order): bool
    {
        // TODO: Implement checkOrderPaymentMethodSelection() method.
        return true;
    }
}