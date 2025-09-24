<?php
namespace App\MessageHandler\Notification;

use App\Message\Notification\OrderCompletedNotificationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Service\Notification\SmsNotification;

#[AsMessageHandler]
final class OrderCompletedSmsHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SmsNotification $sms
    ) {}

    public function __invoke(OrderCompletedNotificationMessage $message): void
    {
        $order = $this->em->getRepository(\App\Entity\Order\Order::class)->find($message->getOrderId());
        if (!$order) {
            return;
        }

        $customer = $order->getCustomer();
        $phone = $customer?->getPhone();
        if ($phone) {
            $this->sms->send($phone, sprintf('Order #%d completed. Thank you!', $order->getId()));
        }
    }
}
