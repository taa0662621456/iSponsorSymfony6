<?php
namespace App\Controller\Api;

use App\Entity\Order\Order;
use App\Service\Order\OrderManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

#[Route('/api/orders')]
final class OrderApiController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly OrderManager $orderManager,
        private readonly EventDispatcherInterface $dispatcher
    ) {}

    #[Route('', name: 'api_order_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $order = new Order();
        // TODO: map items, billing, shipping из $data
        $this->orderManager->finalize($order);

        $this->em->persist($order);
        $this->em->flush();

        return $this->json([
            'id' => $order->getId(),
            'status' => $order->getStatus(),
            'total' => $order->getTotal(),
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'api_order_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);

        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $order->getId(),
            'status' => $order->getStatus(),
            'total' => $order->getTotal(),
        ]);
    }

    #[Route('/{id}/pay', name: 'api_order_pay', methods: ['POST'])]
    public function pay(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);
        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        $this->orderManager->finalize($order);
        $this->dispatcher->dispatch(new GenericEvent($order), 'order.paid');

        $this->em->flush();

        return $this->json(['message' => 'Order paid', 'id' => $order->getId()]);
    }

    #[Route('/{id}/complete', name: 'api_order_complete', methods: ['POST'])]
    public function complete(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);
        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        $this->orderManager->finalize($order);
        $this->dispatcher->dispatch(new GenericEvent($order), 'order.completed');

        $this->em->flush();

        return $this->json(['message' => 'Order completed', 'id' => $order->getId()]);
    }

    #[Route('/{id}/items', name: 'api_order_items', methods: ['GET'])]
    public function items(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);
        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        $items = [];
        foreach ($order->getItems() as $item) {
            $items[] = [
                'id' => $item->getId(),
                'product' => $item->getProduct()?->getName(),
                'quantity' => $item->getQuantity(),
                'subtotal' => $item->getSubtotal(),
            ];
        }

        return $this->json($items);
    }

    #[Route('/{id}/payments', name: 'api_order_payments', methods: ['GET'])]
    public function payments(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);
        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        $payments = [];
        foreach ($order->getPayments() as $payment) {
            $payments[] = [
                'id' => $payment->getId(),
                'amount' => $payment->getAmount(),
                'status' => $payment->getStatus(),
            ];
        }

        return $this->json($payments);
    }

    #[Route('/{id}/shipments', name: 'api_order_shipments', methods: ['GET'])]
    public function shipments(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);
        if (!$order) {
            return $this->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        $shipments = [];
        foreach ($order->getShipments() as $shipment) {
            $shipments[] = [
                'id' => $shipment->getId(),
                'method' => $shipment->getMethod(),
                'status' => $shipment->getStatus(),
            ];
        }

        return $this->json($shipments);
    }
}
