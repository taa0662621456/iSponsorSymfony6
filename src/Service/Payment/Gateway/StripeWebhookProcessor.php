<?php

namespace App\Service\Payment\Gateway;



class StripeWebhookProcessor implements WebhookProcessor
{
    public function __construct(
        private readonly OrderRepository $order,
        private readonly LoggerInterface $logger,
        private readonly string          $secret // из ENV: STRIPE_WEBHOOK_SECRET
    ) {}

    public function handle(string $gateway, Request $request): bool
    {
        if ($gateway !== 'stripe') {
            return false;
        }

        $payload = $request->getContent();
        $sig = $request->headers->get('Stripe-Signature');

        try {
            // Stripe SDK: \Stripe\Webhook::constructEvent($payload, $sig, $this->secret);
            $event = json_decode($payload, true, flags: JSON_THROW_ON_ERROR);

            $eventId = $event['id'] ?? '';
            $type = $event['type'] ?? '';
            $data = $event['data']['object'] ?? [];

            // идемпотентность (по eventId) — проверь в своей таблице
            // если уже обработан — return true;

            if ($type === 'payment_intent.succeeded') {
                $orderId = $data['metadata']['orderId'] ?? null;
                if ($orderId && ($order = $this->order->find($orderId))) {
                    $order->markPaid();
                    $this->order->save($order, flush: true);
                }
            }

            if ($type === 'charge.refunded') {
                $orderId = $data['metadata']['orderId'] ?? null;
                if ($orderId && ($order = $this->order->find($orderId))) {
                    $order->markRefunded();
                    $this->order->save($order, flush: true);
                }
            }

            $this->logger->info('stripe:webhook', ['id' => $eventId, 'type' => $type]);
            return true;
        } catch (\Throwable $e) {
            $this->logger->error('stripe:webhook_error', ['e' => $e]);
            return false;
        }
    }
}