<?php
namespace App\MessageHandler\Notification;

use App\Message\Notification\OrderPaidNotificationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class OrderPaidMailHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly MailerInterface $mailer
    ) {}

    public function __invoke(OrderPaidNotificationMessage $message): void
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
            ->subject(sprintf('Order #%d paid', $order->getId()))
            ->text(sprintf('Your order #%d has been successfully paid. Total: %s', $order->getId(), (string)$order->getTotal()));

        $this->mailer->send($email);
    }
}
