<?php

namespace App\Controller\Admin;

use App\Entity\Order\Order;
use App\Service\Admin\OrderAdminQuery;
use App\Service\Admin\AdminCrudFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/api/orders', name: 'admin_orders_')]
final class OrderAdminController extends AbstractController
{
    public function __construct(
        private readonly OrderAdminQuery $query,
        private readonly AdminCrudFacade $crud
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    #[IsGranted('ROLE_MANAGER')]
    public function list(Request $r): JsonResponse
    {
        $res = $this->query->list(
            status: $r->query->get('status'),
            customerEmail: $r->query->get('customerEmail'),
            paymentStatus: $r->query->get('paymentStatus'),
            page: max(1, (int) $r->query->get('page', 1)),
            limit: max(1, min(100, (int) $r->query->get('limit', 20))),
            sort: $r->query->get('sort', 'createdAt'),
            dir: $r->query->get('dir', 'DESC')
        );
        return new JsonResponse($res, 200);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[IsGranted('DELETE', subject: 'order')]
    public function delete(Order $order)
    {
        return $this->crud->delete(Order::class, $order->getId());
    }
}
