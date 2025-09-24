<?php

namespace App\Service\Payment\Gateway;

use App\Entity\Order\OrderStorage;
use Throwable;

class StripePaymentFacade implements PaymentFacade
{
    public function __construct(
        private OrderRepository $order,
        private LoggerInterface $logger,
        private string $secretKey // STRIPE_SECRET_KEY
    ) {}

    /**
     * @throws Throwable
     */
    public function init(OrderStorage $order, ?string $idempotencyKey = null): array
    {
        try {
            // Stripe SDK: \Stripe\PaymentIntent::create([...], ['idempotency_key' => $idempotencyKey])
            $intentId = 'pi_'.bin2hex(random_bytes(5));
            $clientSecret = 'secret_'.bin2hex(random_bytes(10));

            $this->logger->info('payment:init', ['order' => $order->getId(), 'intent' => $intentId]);

            return [
                'paymentIntentId' => $intentId,
                'clientSecret' => $clientSecret,
            ];
        } catch (Throwable $e) {
            $this->logger->error('payment:init_failed', ['order' => $order->getId(), 'e' => $e]);
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function retry(OrderStorage $order, ?string $idempotencyKey = null): array
    {
        try {
            $intentId = 'pi_retry_'.bin2hex(random_bytes(5));
            $clientSecret = 'secret_retry_'.bin2hex(random_bytes(10));

            $this->logger->info('payment:retry', ['order' => $order->getId(), 'intent' => $intentId]);

            return [
                'paymentIntentId' => $intentId,
                'clientSecret' => $clientSecret,
            ];
        } catch (Throwable $e) {
            $this->logger->error('payment:retry_failed', ['order' => $order->getId(), 'e' => $e]);
            throw $e;
        }
    }
}
