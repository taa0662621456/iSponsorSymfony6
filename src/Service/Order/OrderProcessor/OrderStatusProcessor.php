<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Order\OrderProcessorInterface;

class OrderStatusProcessor implements OrderProcessorInterface
{
    public function process(OrderStorageInterface $order): void
    {

//        тут мы можем проверить, какой статус ордера
//        если имеет подтвержденную оплату, то...
//        если в процессе, то ...$this
//            или же, что-то другое


    }
}
