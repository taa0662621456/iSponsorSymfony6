<?php

namespace App\Controller\Order;


use App\Entity\Order\OrderItem;
use App\Service\OrderItemServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;


#[AsController]
#[Route('/order/item', name: 'order_item_')]
class OrderItemController extends AbstractController
{
    public function __construct(private readonly OrderItemServiceInterface $svc) {}

    #[Route('/{id}/update-qty', name: 'update_qty', methods: ['POST'])]
    public function updateQty(OrderItem $item, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_EDIT', $item->getOrder());
        if (!$this->isCsrfTokenValid('order_item_'.$item->getId(), $r->request->get('_token'))) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }

        $qty = max(0, (int) $r->request->get('qty'));
        $dto = $this->svc->updateQty($item, $qty, by: $this->getUser());
        return $this->json($dto, 200, ['Cache-Control' => 'no-store']);
    }
    public function orderItemAdd(Request $request)
    {

    }

    public function orderItemRemove(Request $request)
    {
    }

    protected function orderItemQuantityIncrease(Request $request)
    {

    }

    protected function orderItemQuantityDecrease(Request $request)
    {

    }
}
