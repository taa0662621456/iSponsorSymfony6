<?php

namespace App\Controller\Cart;

use App\Service\CheckoutServiceInterface;
use App\Service\OrderFactoryInterface;
use App\Service\PriceCalculatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('cart/checkout', name: 'cart_checkout_')]
class CartCheckoutController extends AbstractController
{
    public function __construct(
        private readonly CheckoutServiceInterface $checkout,
        private readonly OrderFactoryInterface    $orders,
        private readonly PriceCalculatorInterface $pricing,
        private readonly LoggerInterface $logger
    ) {}

    #[Route('/start', name: 'start', methods: ['POST'])]
    public function start(Request $r): JsonResponse
    {
        $this->assertCsrf('checkout', $r->request->get('_token'));
        $idemp = (string) ($r->headers->get('Idempotency-Key') ?? '');
        $snapshot = $this->pricing->recalculate($this->checkout->getCart());
        $this->checkout->start($idemp, $snapshot); // сохраняет снэпшот, фиксирует цены/скидки/налоги
        return $this->json(['status' => 'OK', 'snapshot' => $snapshot], 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/shipping', name: 'shipping', methods: ['POST'])]
    public function setShipping(Request $r): JsonResponse
    {
        $this->assertCsrf('checkout', $r->request->get('_token'));
        $address = $r->request->all('address');
        $methodCode = (string) $r->request->get('method');

        $this->checkout->setShipping($address, $methodCode);
        return $this->json(['status' => 'OK'], 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/payment', name: 'payment', methods: ['POST'])]
    public function setPayment(Request $r): JsonResponse
    {
        $this->assertCsrf('checkout', $r->request->get('_token'));
        $methodCode = (string) $r->request->get('method');
        $this->checkout->setPayment($methodCode); // валидирует метод, доступность, доп. сборы
        return $this->json(['status' => 'OK'], 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/place', name: 'place', methods: ['POST'])]
    public function placeOrder(Request $r): JsonResponse
    {
        $this->assertCsrf('checkout', $r->request->get('_token'));
        $idemp = (string) ($r->headers->get('Idempotency-Key') ?? '');

        $order = $this->orders->placeFromCheckout($this->getUser(), $idemp);
        $this->logger->info('order:placed', ['order' => $order->getId(), 'user' => $this->getUser()?->getUserIdentifier()]);

        return $this->json(['orderId' => $order->getId()], 201, ['Cache-Control' => 'no-store']);
    }

    private function assertCsrf(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
    }

    #[Route(path: 'cart/checkout', name: '', methods: ['GET'])]
    public function checkout()
    {

    }
    #[Route(path: 'cart/address', name: '', methods: ['GET', 'PUT'])]
    public function checkout_address()
    {

    }
    #[Route(path: 'cart/shipping', name: '', methods: ['GET', 'PUT'])]
    public function checkout_shipping()
    {

    }
    #[Route(path: 'cart/payment', name: '', methods: ['GET', 'PUT'])]
    public function checkout_payment()
    {

    }
    #[Route(path: 'cart/complete', name: '', methods: ['GET', 'PUT'])]
    public function checkout_complete()
    {

    }



}