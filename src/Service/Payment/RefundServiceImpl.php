<?php

namespace App\Service\Payment;

use App\Entity\Order\OrderStorage;
use App\Repository\Order\OrderRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class RefundServiceImpl implements RefundService
{
    public function __construct(
        private OrderRepository $order,
        private LoggerInterface $logger
    ) {}

    /**
     * @throws Throwable
     */
    public function startRefund(OrderStorage $order, array $item, object $by): array
    {
        try {
            $amount = 0;
            foreach ($item as $i) {
                $amount += (int) $i['amountCents'];
            }

            if ($amount <= 0 || $amount > $order->getTotalCents()) {
                throw new \InvalidArgumentException('Invalid refund amount');
            }

            // Stripe SDK: \Stripe\Refund::create(['payment_intent' => $order->getPaymentIntentId(), 'amount' => $amount])
            $refundId = 're_'.bin2hex(random_bytes(5));

            $order->markRefundPending($refundId, $amount, $by);
            $this->order->save($order, flush: true);

            $this->logger->info('refund:start', ['order' => $order->getId(), 'amount' => $amount]);

            return ['refundId' => $refundId, 'status' => 'PENDING', 'amount' => $amount];
        } catch (Throwable $e) {
            $this->logger->error('refund:error', ['order' => $order->getId(), 'e' => $e]);
            throw $e;
        }
    }
}
