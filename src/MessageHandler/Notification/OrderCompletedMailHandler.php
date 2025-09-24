<?php
namespace App\MessageHandler\Notification;

use App\Message\Notification\OrderCompletedNotificationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class OrderCompletedMailHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly MailerInterface $mailer
    ) {}

    public function __invoke(OrderCompletedNotificationMessage $message): void
    {
        $order = $this->em->getRepository(\App\Entity\Order\Order::class)->find($message->getOrderId());
        if (!$order) {
            return;
        }

        $customer = $order->getCustomer();
        if (!$customer || !$customer->getEmail()) {
            return;
        }

        $email = (new Email())
            ->to($customer->getEmail())
            ->subject(sprintf('Order #%d completed', $order->getId()))
            ->text(sprintf('Your order #%d has been completed. Thank you!', $order->getId()));

        $this->mailer->send($email);
    }
}
