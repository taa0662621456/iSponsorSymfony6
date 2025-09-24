<?php


namespace App\Controller\Order;

use App\Entity\Order\OrderStorage;
use App\Service\Shipment\ShipmentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/order/shipment', name: 'order_shipment_')]
class OrderShipmentController extends AbstractController
{
    public function __construct(private readonly ShipmentService $shipment) {}

    #[Route('/{id}/set-method', name: 'set_method', methods: ['POST'])]
    public function setMethod(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_EDIT', $order);
        $this->assertCsrf('order_ship_'.$order->getId(), $r->request->get('_token'));

        $method = (string) $r->request->get('method');
        $dto = $this->shipment->setMethod($order, $method, by: $this->getUser());
        return $this->json($dto, 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/{id}/tracking', name: 'tracking', methods: ['POST'])]
    public function setTracking(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_EDIT', $order);
        $this->assertCsrf('order_ship_'.$order->getId(), $r->request->get('_token'));

        $carrier = (string) $r->request->get('carrier');
        $track   = (string) $r->request->get('tracking');

        $dto = $this->shipment->setTracking($order, $carrier, $track, by: $this->getUser());
        return $this->json($dto, 200, ['Cache-Control' => 'no-store']);
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
