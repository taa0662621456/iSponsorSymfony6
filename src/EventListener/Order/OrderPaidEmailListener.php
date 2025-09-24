<?php
namespace App\EventListener;

use App\Event\OrderPaidEvent;

class OrderPaidEmailListener
{
    public function __invoke(OrderPaidEvent $event): void
    {
        $order = $event->order;
        // TODO: вызвать mailer, сформировать письмо клиенту
    }
}
