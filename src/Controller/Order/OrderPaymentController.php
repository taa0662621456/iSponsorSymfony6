<?php


namespace App\Controller\Order;

use App\Entity\Order\OrderStorage;
use App\Service\PaymentFacadeInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/order/payment', name: 'order_payment_')]
class OrderPaymentController extends AbstractController
{
    public function __construct(private readonly PaymentFacadeInterface $payment, private readonly LoggerInterface $logger) {}

    #[Route('/{id}/init', name: 'init', methods: ['POST'])]
    public function init(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_PAY', $order);
        $this->assertCsrf('order_pay_'.$order->getId(), $r->request->get('_token'));

        $intent = $this->payment->init($order, idempotencyKey: $r->headers->get('Idempotency-Key'));
        return $this->json($intent, 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/{id}/retry', name: 'retry', methods: ['POST'])]
    public function retry(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_PAY', $order);
        $this->assertCsrf('order_pay_'.$order->getId(), $r->request->get('_token'));

        $intent = $this->payment->retry($order, idempotencyKey: $r->headers->get('Idempotency-Key'));
        return $this->json($intent, 200, ['Cache-Control' => 'no-store']);
    }

    private function assertCsrf(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
    }

    public function getPaymentGatewaysAction(Request $request)
    {

    }
}
